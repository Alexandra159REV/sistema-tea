import mysql.connector
import requests
import json
import time
import sys
import os

# Ajuste de ruta para encontrar el módulo de conexión en la raíz
sys.path.append(os.path.abspath(os.path.join(os.path.dirname(__file__), '../..')))
from db_connection import db 

# 🔹 OLLAMA CONFIG
OLLAMA_GENERATE_URL = "http://localhost:11434/api/generate"
OLLAMA_EMBED_URL = "http://localhost:11434/api/embeddings"

MODEL_TEXT = "llama3"
MODEL_EMBED = "nomic-embed-text"

cursor = db.cursor(dictionary=True)

# 📥 OBTENER TODOS LOS PICTOGRAMAS DESDE EL ID 51
# Usamos esta consulta para forzar la actualización de todo lo que esté mal
cursor.execute("""
SELECT Id, Title 
FROM Pictograms
WHERE Id >= 51
ORDER BY Id ASC
""")

pictos = cursor.fetchall()
print(f"Total de registros a verificar/procesar desde ID 51: {len(pictos)}")

# 🧠 GENERAR SEARCHTEXT CON OLLAMA
def generar_searchtext(titulo):
    prompt = f"""
    Genera palabras clave y sinónimos en español para: "{titulo}".
    Devuelve solo palabras separadas por espacios. Máximo 10 palabras.
    """
    response = requests.post(OLLAMA_GENERATE_URL, json={
        "model": MODEL_TEXT,
        "prompt": prompt,
        "stream": False
    })
    data = response.json()
    return data["response"].strip().lower()

# ⚡ GENERAR EMBEDDING CON OLLAMA
def generar_embedding(texto):
    response = requests.post(OLLAMA_EMBED_URL, json={
        "model": MODEL_EMBED,
        "prompt": texto
    })
    data = response.json()
    return data["embedding"]

# 🔄 PROCESAR BUCLE
for p in pictos:
    try:
        print(f"Procesando ID {p['Id']}: {p['Title']}")

        # 1. Generar palabras clave
        search_text = generar_searchtext(p["Title"])
        
        # 2. Generar embedding
        embedding = generar_embedding(search_text)

        # 3. Guardar/Sobrescribir en BD
        cursor.execute("""
        UPDATE Pictograms
        SET SearchText = %s,
            Embedding = %s,
            EmbeddingModel = %s
        WHERE Id = %s
        """, (
            search_text,
            json.dumps(embedding),
            MODEL_EMBED,
            p["Id"]
        ))

        db.commit()
        time.sleep(0.1) # Pausa breve para estabilidad

    except Exception as e:
        print(f"❌ Error en ID {p['Id']} ({p['Title']}): {e}")

print("🔥 PROCESO COMPLETADO: Todos los pictogramas desde el 51 han sido actualizados.")