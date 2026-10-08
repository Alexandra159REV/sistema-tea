import mysql.connector
import ollama
import json
import numpy as np  # Necesitaremos esto para la matemática

# 1. Conexión a la base de datos de Laragon
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tea_web"
)
cursor = db.cursor(dictionary=True)

def cosine_similarity(v1, v2):
    # Función matemática para ver qué tan parecidos son dos vectores
    return np.dot(v1, v2) / (np.linalg.norm(v1) * np.linalg.norm(v2))

def buscar_pictogramas(query_texto, limite=5):
    # 2. Convertir la búsqueda del usuario en un embedding
    response = ollama.embeddings(model='nomic-embed-text', prompt=query_texto)
    query_embedding = response['embedding']
    
    # 3. Traer los datos de la BD
    cursor.execute("SELECT Id, Title, SearchText, Embedding FROM Pictograms")
    resultados = cursor.fetchall()
    
    busquedas_con_score = []

    for fila in resultados:
        if fila['Embedding']:
            # Convertimos el texto de la BD de nuevo a una lista de números
            db_embedding = json.loads(fila['Embedding'])
            
            # Calculamos la similitud
            score = cosine_similarity(query_embedding, db_embedding)
            
            busquedas_con_score.append({
                'id': fila['Id'],
                'titulo': fila['Title'],
                'score': score
            })

    # 4. Ordenar por los más parecidos (el score más alto primero)
    busquedas_con_score.sort(key=lambda x: x['score'], reverse=True)

    print(f"\n🔍 Resultados para: '{query_texto}'")
    print("-" * 50)
    for res in busquedas_con_score[:limite]:
        print(f"ID: {res['id']} | Título: {res['titulo']} | Similitud: {res['score']:.4f}")

# Ejecución
if __name__ == "__main__":
    busqueda = input("¿Qué quieres buscar en tus pictogramas?: ")
    buscar_pictogramas(busqueda)