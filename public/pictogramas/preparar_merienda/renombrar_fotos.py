import os
import pandas as pd

# =============================
# 1. CARGAR CSV
# =============================
csv_path = r'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\preparar_merienda\preparar_merienda.csv'

if not os.path.exists(csv_path):
    print(f"Error: No encuentro el archivo '{csv_path}'")
    exit()

# Leer con separador correcto
df = pd.read_csv(csv_path, sep=None, engine='python', encoding='utf-8-sig')

# Limpiar nombres de columnas
df.columns = df.columns.str.strip().str.lower()

print("Columnas detectadas:", df.columns.tolist())

# Detectar columna de número (con o sin tilde)
if 'numero' in df.columns:
    col_num = 'numero'
elif 'número' in df.columns:
    col_num = 'número'
else:
    print("ERROR: No se encontró columna 'numero'")
    exit()

# Detectar columna de nombre
if 'nombre' in df.columns:
    col_nom = 'nombre'
else:
    print("ERROR: No se encontró columna 'nombre'")
    exit()

# =============================
# 2. RUTA DE IMÁGENES
# =============================
ruta_imagenes = r'D:\laragon\www\TEA web\tea-laravel\public\pictogramas\preparar_merienda'

print(f"\nBuscando carpeta en: {ruta_imagenes}")

if not os.path.exists(ruta_imagenes):
    print("ERROR: La carpeta no existe.")
    exit()
else:
    print(f"Carpeta encontrada. Renombrando {len(df)} archivos...\n")

# =============================
# 3. RENOMBRADO
# =============================
count = 0

for index, row in df.iterrows():
    numero = str(row[col_num]).strip()
    nuevo_nombre = str(row[col_nom]).strip()

    # limpiar caracteres problemáticos
    nuevo_nombre = nuevo_nombre.replace(" ", "_")

    nombre_antiguo = f"{numero}.png"
    ruta_antigua = os.path.join(ruta_imagenes, nombre_antiguo)
    ruta_nueva = os.path.join(ruta_imagenes, f"{nuevo_nombre}.png")

    if os.path.exists(ruta_antigua):
        try:
            # Evitar sobreescritura
            if os.path.exists(ruta_nueva):
                print(f"⚠ Ya existe: {nuevo_nombre}.png")
                continue

            os.rename(ruta_antigua, ruta_nueva)
            print(f" {nombre_antiguo} -> {nuevo_nombre}.png")
            count += 1

        except Exception as e:
            print(f" Error al renombrar {nombre_antiguo}: {e}")

    else:
        print(f" No existe: {nombre_antiguo}")

# =============================
# 4. RESULTADO
# =============================
print(f"\n--- Proceso terminado ---")
print(f"Se renombraron {count} imágenes")