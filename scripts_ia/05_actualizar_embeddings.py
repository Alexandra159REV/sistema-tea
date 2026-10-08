import mysql.connector
from openai import OpenAI

# 1. Tu API KEY de OpenAI
client = OpenAI(api_key="TU_API_KEY_AQUI")

# 2. Conexión a Laragon
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tea_web"
)
cursor = db.cursor()

# 3. Traer pictogramas sin inteligencia
cursor.execute("SELECT id, Title FROM pictogramas WHERE Embedding IS NULL")
registros = cursor.fetchall()

print(f"Procesando {len(registros)} pictogramas...")

for (id_pic, title) in registros:
    try:
        # Generar vector
        response = client.embeddings.create(
            input=title,
            model="text-embedding-3-small"
        )
        vector = str(response.data[0].embedding)
        
        # Guardar en la base de datos
        sql = "UPDATE pictogramas SET Embedding = %s, SearchText = %s WHERE id = %s"
        cursor.execute(sql, (vector, title.lower(), id_pic))
        db.commit()
        print(f"✓ Procesado: {title}")
    except Exception as e:
        print(f"Error en {title}: {e}")

db.close()
print("¡TERMINADO! Ahora tus pictogramas tienen inteligencia artificial.")