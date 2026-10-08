import sys
import os
import json
import numpy as np
from sentence_transformers import SentenceTransformer, util

def buscar(query):
    dir_actual = os.path.dirname(os.path.abspath(__file__))
    ruta_embeddings = os.path.join(dir_actual, 'pictogramas_embeddings.npy')
    ruta_json = os.path.join(dir_actual, 'pictogramas_lista.json')
    
    model = SentenceTransformer('all-MiniLM-L6-v2')
    embeddings = np.load(ruta_embeddings)
    
    with open(ruta_json, 'r', encoding='utf-8') as f:
        lista = json.load(f)
    
    query_embedding = model.encode(query)
    hits = util.semantic_search(query_embedding, embeddings, top_k=1)
    
    best_hit = hits[0][0]
    pictograma = lista[best_hit['corpus_id']]
    
    return pictograma['path']

if __name__ == "__main__":
    query_usuario = sys.argv[1] if len(sys.argv) > 1 else "necesito un pictograma"
    ruta_encontrada = buscar(query_usuario)
    print(ruta_encontrada)