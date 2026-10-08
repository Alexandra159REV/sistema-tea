import mysql.connector
import requests
import json

# 1. Configuración de la Base de Datos
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
OLLAMA_URL = "http://localhost:11434/api/embeddings"
MODELO = "mxbai-embed-large"

# 3. Traer pictogramas sin inteligencia
cursor.execute("SELECT id, Title FROM pictogramas WHERE Embedding IS NULL")
registros = cursor.fetchall()

print(f"Procesando {len(registros)} pictogramas localmente con Ollama...")

for (id_pic, title) in registros:
    try:
        # Llamada local a Ollama
        payload = {
            "model": MODELO,
            "prompt": title
        }
        
        response = requests.post(OLLAMA_URL, json=payload)
        response_data = response.json()
        
        # Extraer el vector
        vector = str(response_data['embedding'])
        
        # Actualizar la base de datos
        sql = "UPDATE pictogramas SET Embedding = %s, SearchText = %s, EmbeddingModel = %s WHERE id = %s"
        cursor.execute(sql, (vector, title.lower(), MODELO, id_pic))
        db.commit()
        
        print(f"✓ Localmente procesado: {title}")
        
    except Exception as e:
        print(f"Error en {title}: {e}")

db.close()
print("\n¡TERMINADO! Has generado todos los embeddings usando Ollama sin gastar dinero.")