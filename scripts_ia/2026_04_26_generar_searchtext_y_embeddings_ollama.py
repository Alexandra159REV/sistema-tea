import mysql.connector
import requests
import json
import time
import re

# =========================================================
# CONFIGURACIÓN MYSQL
# =========================================================

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tea_web"
)

cursor = db.cursor(dictionary=True)

# =========================================================
# CONFIG OLLAMA
# =========================================================

OLLAMA_GENERATE_URL = "http://localhost:11434/api/generate"
OLLAMA_EMBED_URL = "http://localhost:11434/api/embeddings"

MODEL_TEXT = "llama3"
MODEL_EMBED = "nomic-embed-text"

# =========================================================
# CONFIG
# =========================================================

DELAY = 0.3

# =========================================================
# OBTENER SOLO LOS NO PROCESADOS
# =========================================================

cursor.execute("""
SELECT id, Title
FROM pictogramas
WHERE
    SearchText IS NULL
    OR SearchText = ''
    OR Embedding IS NULL
ORDER BY id ASC
""")

pictos = cursor.fetchall()

print(f"\nTOTAL PENDIENTES: {len(pictos)}\n")

# =========================================================
# LIMPIAR TEXTO
# =========================================================

def limpiar_texto(texto):

    texto = texto.lower()

    texto = re.sub(r'v\d+', '', texto)

    texto = re.sub(
        r'[^a-zA-Záéíóúñü0-9 ]',
        ' ',
        texto
    )

    texto = re.sub(r'\s+', ' ', texto)

    return texto.strip()

# =========================================================
# GENERAR SEARCHTEXT
# =========================================================

def generar_searchtext(titulo):

    titulo_limpio = limpiar_texto(titulo)

    prompt = f"""
Genera palabras clave semánticas y sinónimos en español
para un pictograma educativo TEA.

Título:
{titulo_limpio}

Reglas:
- incluir acciones relacionadas
- incluir objetos relacionados
- incluir categorías relacionadas
- máximo 20 palabras
- no repetir palabras
- devolver SOLO palabras separadas por comas
- no explicar nada
"""

    try:

        response = requests.post(
            OLLAMA_GENERATE_URL,
            json={
                "model": MODEL_TEXT,
                "prompt": prompt,
                "stream": False
            },
            timeout=120
        )

        data = response.json()

        texto = data["response"].strip().lower()

        texto = texto.replace("\n", " ")
        texto = texto.replace(".", " ")

        return texto

    except Exception as e:

        print(f"ERROR SEARCHTEXT: {e}")

        return titulo_limpio

# =========================================================
# GENERAR EMBEDDING
# =========================================================

def generar_embedding(texto):

    try:

        response = requests.post(
            OLLAMA_EMBED_URL,
            json={
                "model": MODEL_EMBED,
                "prompt": texto
            },
            timeout=120
        )

        data = response.json()

        if "embedding" not in data:
            return None

        return data["embedding"]

    except Exception as e:

        print(f"ERROR EMBEDDING: {e}")

        return None

# =========================================================
# ACTUALIZAR MYSQL
# =========================================================

def actualizar_bd(id_pictograma, searchtext, embedding):

    cursor.execute("""
    UPDATE pictogramas
    SET
        SearchText = %s,
        Embedding = %s,
        EmbeddingModel = %s,
        updated_at = NOW()
    WHERE id = %s
    """, (
        searchtext,
        json.dumps(embedding) if embedding else None,
        MODEL_EMBED,
        id_pictograma
    ))

    db.commit()

# =========================================================
# PROCESAMIENTO
# =========================================================

procesados = 0
errores = 0

for i, p in enumerate(pictos):

    try:

        print("\n" + "=" * 60)
        print(f"[{i+1}/{len(pictos)}]")
        print(f"ID: {p['id']}")
        print(f"TITULO: {p['Title']}")

        # -------------------------------------------------
        # SEARCHTEXT
        # -------------------------------------------------

        search_text = generar_searchtext(p["Title"])

        print(f"\nSEARCHTEXT:")
        print(search_text)

        # -------------------------------------------------
        # EMBEDDING
        # -------------------------------------------------

        embedding = generar_embedding(search_text)

        if embedding is None:

            print("EMBEDDING NULL")

            errores += 1

            continue

        print(f"\nEMBEDDING OK ({len(embedding)} dimensiones)")

        # -------------------------------------------------
        # GUARDAR
        # -------------------------------------------------

        actualizar_bd(
            p["id"],
            search_text,
            embedding
        )

        procesados += 1

        print("GUARDADO EN MYSQL")

        time.sleep(DELAY)

    except Exception as e:

        errores += 1

        print("\nERROR GENERAL:")
        print(e)

# =========================================================
# FINAL
# =========================================================

print("\n" + "=" * 60)
print("PROCESO TERMINADO")
print(f"PROCESADOS: {procesados}")
print(f"ERRORES: {errores}")
print("=" * 60)

cursor.close()
db.close()