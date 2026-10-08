import mysql.connector
import requests
import json

# 1. Conexión a la base de datos
try:
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="tea_web"
    )
    cursor = db.cursor()
except Exception as e:
    print(f"Error de conexión: {e}")
    exit()

# 2. Configuración de Ollama
OLLAMA_GENERATE_URL = "http://localhost:11434/api/generate"
MODELO_TEXTO = "llama3" 

def obtener_palabras_clave(titulo):
    # Prompt reforzado para garantizar que TODO sea en ESPAÑOL
    prompt = f"""
    Actúa como un experto en educación especial y TEA.
    Para el pictograma llamado: "{titulo}", genera una lista de 20 palabras clave y sinónimos.
    
    REGLAS OBLIGATORIAS:
    1. Responde ÚNICAMENTE en idioma ESPAÑOL.
    2. Prohibido usar palabras en inglés.
    3. Entrega solo las palabras separadas por comas.
    4. No incluyas introducciones ni explicaciones, solo el listado de palabras.
    5. Incluye contextos de uso, verbos de acción y objetos relacionados, todo en español.
    """
    
    payload = {
        "model": MODELO_TEXTO,
        "prompt": prompt,
        "stream": False
    }
    
    try:
        response = requests.post(OLLAMA_GENERATE_URL, json=payload)
        # Limpiamos el resultado y lo pasamos a minúsculas
        resultado = response.json()['response'].strip().lower()
        return resultado
    except Exception as e:
        print(f"Error con Ollama en {titulo}: {e}")
        return ""

# 3. Procesar los registros
# Nota: He quitado el filtro de "WHERE SearchText IS NULL" para que se actualicen 
# incluso los que estaban en inglés y se corrijan a español.
cursor.execute("SELECT id, Title FROM pictogramas")
registros = cursor.fetchall()

print(f"Enriqueciendo SearchText para {len(registros)} pictogramas (MODO SOLO ESPAÑOL)...")

for (id_pic, title) in registros:
    # La IA genera las palabras clave en español
    palabras_ia = obtener_palabras_clave(title)
    
    # Combinamos el título original con el resultado de la IA
    # Si la IA falló, al menos guardamos el título original
    if palabras_ia:
        texto_completo = f"{title.lower()}, {palabras_ia}"
    else:
        texto_completo = title.lower()
    
    # Guardamos en la columna SearchText
    sql = "UPDATE pictogramas SET SearchText = %s WHERE id = %s"
    cursor.execute(sql, (texto_completo, id_pic))
    db.commit()
    print(f"✓ {title}: SearchText actualizado en español.")

db.close()
print("\n¡TERMINADO! Revisa HeidiSQL, ahora todo debería estar en español.")