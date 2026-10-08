import os
import json
import numpy as np
from sentence_transformers import SentenceTransformer

# 1. Cargamos el modelo que convierte texto a vectores
model = SentenceTransformer('all-MiniLM-L6-v2')

def indexar():
    ruta_base = "public/storage/pictogramas"
    pictogramas = []
    
    print("🚀 Iniciando indexación de pictogramas...")

    print(f"DEBUG: Buscando imágenes en la ruta absoluta: {os.path.abspath(ruta_base)}")


    # 2. Recorremos todas las carpetas (Opción C)
    for root, dirs, files in os.walk(ruta_base):
        for file in files:
            if file.lower().endswith(('.png', '.jpg')):
                # Creamos una descripción basada en la carpeta y el nombre
                categoria = os.path.basename(root)
                nombre = os.path.splitext(file)[0].replace('_', ' ')
                descripcion = f"pictograma de {nombre} relacionado con {categoria}"
                
                pictogramas.append({
                    "id": len(pictogramas),
                    "path": os.path.join(root, file),
                    "descripcion": descripcion
                })
    
    # 3. Generamos los vectores (embeddings)
    descripciones = [p["descripcion"] for p in pictogramas]
    embeddings = model.encode(descripciones)
    
    # 4. Guardamos los resultados
    np.save('scripts_ia/pictogramas_embeddings.npy', embeddings)
    with open('scripts_ia/pictogramas_lista.json', 'w') as f:
        json.dump(pictogramas, f)
        
    print(f"✅ ¡Éxito! Indexados {len(pictogramas)} pictogramas.")

if __name__ == "__main__":
    indexar()