import os
import mysql.connector
from datetime import datetime

# 1. Configuración de Conexión
try:
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="tea_web" 
    )
    cursor = db.cursor()
except Exception as e:
    print(f"Error de conexión: {e}")
    exit()

# 2. Ruta de tus imágenes (D:\laragon\www\TEA web\tea-laravel\storage\app\public\pictogramas)
ruta_base = r'D:\laragon\www\TEA web\tea-laravel\storage\app\public\pictogramas'

print("Iniciando importación definitiva...")
total = 0

if not os.path.exists(ruta_base):
    print(f"ERROR: No se encontró la carpeta en {ruta_base}")
    exit()

for categoria in os.listdir(ruta_base):
    ruta_categoria = os.path.join(ruta_base, categoria)
    if os.path.isdir(ruta_categoria):
        for archivo in os.listdir(ruta_categoria):
            if archivo.lower().endswith(('.png', '.jpg', '.jpeg', '.webp')):
                
                # --- Preparar solo lo que tu tabla tiene ---
                nombre_limpio = archivo.split('.')[0].replace('_', ' ').replace('-', ' ').capitalize()
                # La ruta que Laravel entiende para la web
                ruta_db = f"storage/app/public/pictogramas/{categoria}/{archivo}"
                ahora = datetime.now()

                # --- Inserción con las 4 columnas de tu imagen ff8afb.png ---
                sql = "INSERT INTO pictogramas (Title, ImagePath, created_at, updated_at) VALUES (%s, %s, %s, %s)"
                valores = (nombre_limpio, ruta_db, ahora, ahora)
                
                try:
                    cursor.execute(sql, valores)
                    total += 1
                    if total % 100 == 0:
                        print(f"Registrados {total} pictogramas...")
                except Exception as e:
                    print(f"Error en {archivo}: {e}")

db.commit()
print(f"\n¡ÉXITO TOTAL! Se insertaron {total} pictogramas correctamente.")
cursor.close()
db.close()