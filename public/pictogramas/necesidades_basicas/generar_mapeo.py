import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (16 elementos)
ids = [
    "4652", "5590", "6952", "7257", "11356", "26865", "35557", "35561", 
    "35569", "35583", "35589", "35597", "35721", "36407", "37682", "37957"
]

# Lista de Nombres (16 elementos)
nombres = [
    "vaso_hielo", "soñar", "calor", "soñar_v2", "picor", "frio", "tiritar", "calor_v2", 
    "mareo", "tiritar_v2", "frio_v2", "calor_v3", "sudor", "lampara_calor", "dormir_monitoreado", "bolsa_frio"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")