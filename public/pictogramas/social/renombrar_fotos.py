import os
import pandas as pd

# =============================
# 1. RUTA DEL CSV
# =============================
csv_path = r'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\social\social.csv'

if not os.path.exists(csv_path):
    print(f"Error: No encuentro el archivo '{csv_path}'")
    exit()

# =============================
# 2. CARGAR CSV (ULTRA ROBUSTO)
# =============================

try:
    # Intento 1: separador ;
    df = pd.read_csv(csv_path, sep=';', encoding='utf-8-sig')
except:
    try:
        # Intento 2: separador ,
        df = pd.read_csv(csv_path, sep=',', encoding='utf-8-sig')
    except Exception as e:
        print("ERROR leyendo CSV:", e)
        exit()

# =============================
# 3. LIMPIEZA DE COLUMNAS
# =============================

# Limpiar nombres de columnas
df.columns = df.columns.str.strip().str.lower()

print("Columnas detectadas:", df.columns.tolist())

# CASO PROBLEMÁTICO: todo viene en una sola columna tipo "numero;nombre"
if len(df.columns) == 1:
    print("⚠ CSV mal formateado, separando columnas manualmente...")

    col = df.columns[0]
    df[['numero', 'nombre']] = df[col].str.split(';', expand=True)
else:
    # Normalizar nombres (quitar tildes)
    columnas = {col: col.replace('ú','u').replace('ó','o') for col in df.columns}
    df.rename(columns=columnas, inplace=True)

# =============================
# 4. VALIDACIÓN DE COLUMNAS
# =============================

if 'numero' not in df.columns or 'nombre' not in df.columns:
    print("ERROR: No se encontraron columnas 'numero' y 'nombre'")
    exit()

# =============================
# 5. RUTA DE IMÁGENES
# =============================

ruta_imagenes = r'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\social'

print(f"\nBuscando carpeta en: {ruta_imagenes}")

if not os.path.exists(ruta_imagenes):
    print("ERROR: La carpeta no existe.")
    exit()

print(f"Carpeta encontrada. Renombrando {len(df)} archivos...\n")

# =============================
# 6. RENOMBRADO
# =============================

renombrados = 0
no_encontrados = 0
ya_existen = 0

for _, row in df.iterrows():
    numero = str(row['numero']).strip()
    nuevo_nombre = str(row['nombre']).strip()

    # limpiar nombre
    nuevo_nombre = nuevo_nombre.replace(" ", "_")

    nombre_antiguo = f"{numero}.png"
    ruta_antigua = os.path.join(ruta_imagenes, nombre_antiguo)
    ruta_nueva = os.path.join(ruta_imagenes, f"{nuevo_nombre}.png")

    if os.path.exists(ruta_antigua):
        if os.path.exists(ruta_nueva):
            print(f"⚠ Ya existe: {nuevo_nombre}.png")
            ya_existen += 1
            continue

        try:
            os.rename(ruta_antigua, ruta_nueva)
            print(f" {nombre_antiguo} -> {nuevo_nombre}.png")
            renombrados += 1
        except Exception as e:
            print(f" Error: {e}")
    else:
        print(f" No existe: {nombre_antiguo}")
        no_encontrados += 1

# =============================
# 7. RESULTADO FINAL
# =============================

print("\n--- RESUMEN ---")
print(f" Renombrados: {renombrados}")
print(f" Ya existían: {ya_existen}")
print(f" No encontrados: {no_encontrados}")