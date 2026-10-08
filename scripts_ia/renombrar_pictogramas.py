import os
import mysql.connector

# 🔹 CONFIGURACIÓN
BASE_PATH = r"D:/laragon/www/TEA web/tea-laravel/storage/app/public/pictogramas"

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tea_web"
)

cursor = db.cursor()

def generar_nombre(categoria, contador):
    return f"{categoria}_{contador}"

for categoria in os.listdir(BASE_PATH):

    ruta_categoria = os.path.join(BASE_PATH, categoria)

    if not os.path.isdir(ruta_categoria):
        continue

    contador = 1

    for archivo in os.listdir(ruta_categoria):

        if not archivo.endswith(".png"):
            continue

        nombre, ext = os.path.splitext(archivo)

        # SOLO si el nombre es número
        if nombre.isnumeric():

            nuevo_nombre = generar_nombre(categoria, contador)

            ruta_actual = os.path.join(ruta_categoria, archivo)
            nueva_ruta = os.path.join(ruta_categoria, nuevo_nombre + ext)

            # Renombrar archivo
            os.rename(ruta_actual, nueva_ruta)

            print(f"{archivo} → {nuevo_nombre}.png")

            # Actualizar BD
            cursor.execute("""
                UPDATE Pictograms
                SET Title = %s,
                    ImagePath = %s
                WHERE ImagePath = %s
            """, (
                nuevo_nombre,
                f"pictogramas/{categoria}/{nuevo_nombre}.png",
                f"pictogramas/{categoria}/{archivo}"
            ))

            db.commit()

            contador += 1

print(" PROCESO TERMINADO")