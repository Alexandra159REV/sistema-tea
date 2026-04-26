import ollama
import pandas as pd
import os
import sys

# --- 1. CONFIGURACIÓN DE RUTAS ---
RUTA_CARPETA = r'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\aseo_personal'
RUTA_CSV = os.path.join(RUTA_CARPETA, 'aseo_personal.csv')

# --- 2. FUNCIONES DE CARGA Y LÓGICA ---

def cargar_vocabulario_desde_csv():
    """Lee el CSV para que la IA solo use términos que existen en Laragon."""
    try:
        if os.path.exists(RUTA_CSV):
            df = pd.read_csv(RUTA_CSV)
            # Retornamos la lista de nombres exactos que están en el CSV
            return df['nombre_pictograma'].tolist()
        else:
            # Vocabulario de emergencia si el CSV no existe todavía
            return ["bañador", "bañarse", "lavarse_los_dientes", "toalla", "pastilla_jabon"]
    except Exception as e:
        print(f"❌ Error al leer el CSV: {e}")
        return []

def encontrar_pictograma_ollama(palabra_usuario):
    """Obliga a Ollama a elegir SOLO términos presentes en el CSV."""
    # Cargamos la lista actualizada directamente del archivo
    lista_permitida = cargar_vocabulario_desde_csv()
    
    prompt = f"""
    SISTEMA DE TRADUCCIÓN PARA NIÑOS CON TEA.
    VOCABULARIO DISPONIBLE: {lista_permitida}
    
    USUARIO ESCRIBE: "{palabra_usuario}"
    
    REGLAS:
    1. Responde ÚNICAMENTE con la palabra exacta de la LISTA.
    2. Si el usuario dice "toallitas" o "toallas", responde "toalla".
    3. Si el usuario dice "jabón", responde "pastilla_jabon".
    4. NO uses mayúsculas, puntos ni explicaciones.
    """

    try:
        response = ollama.chat(model='llama3', messages=[{'role': 'user', 'content': prompt}])
        resultado = response['message']['content'].strip().lower()
        
        # Validación final: solo si el resultado está en el vocabulario real
        if resultado in lista_permitida:
            return resultado
        return "None"
    except Exception as e:
        return None

# --- 3. BLOQUE DE EJECUCIÓN ---
if __name__ == "__main__":
    if len(sys.argv) > 1:
        # Modo integración con Laravel
        palabra_input = sys.argv[1]
        resultado = encontrar_pictograma_ollama(palabra_input)
        print(resultado)
    else:
        # Modo prueba manual en VS Code
        vocabulario = cargar_vocabulario_desde_csv()
        print(f"✅ Vocabulario cargado del CSV: {len(vocabulario)} términos.")
        
        test = "jabón"
        res = encontrar_pictograma_ollama(test)
        print(f"--- Prueba ---\nBuscado: {test}\nResultado IA: {res}")