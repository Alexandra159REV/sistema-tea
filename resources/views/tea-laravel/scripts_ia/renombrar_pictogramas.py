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

cursor = db.cursor(dictionary=True)

# 🔹 FUNCIÓN SIMPLE (puedes mejorar con IA luego)
def generar_nombre(categoria):
    nombres_base = {
        "comida": "comida",
        "aseo_personal": "aseo",
        "emociones": "emocion",
        "tareas_hogar": "tarea",
    }
    return nombres_base.get(categoria, "actividad")

# 🔹 RECORRER CARPETAS
for categoria in os.listdir(BASE_PATH):

    ruta_categoria = os.path.join(BASE_PATH, categoria)

    if not os.path.isdir(ruta_categoria):
        continue

    contador = 1

    for archivo in os.listdir(ruta_categoria):

        if not archivo.endswith(".png"):
            continue

        nombre, ext = os.path.splitext(archivo)

        #  SOLO SI ES NUMÉRICO
        if nombre.isnumeric():

            nuevo_nombre = f"{generar_nombre(categoria)}_{contador}"
            nueva_ruta = os.path.join(ruta_categoria, nuevo_nombre + ext)

            ruta_actual = os.path.join(ruta_categoria, archivo)

            # Renombrar archivo
            os.rename(ruta_actual, nueva_ruta)

            print(f"Renombrado: {archivo} → {nuevo_nombre}.png")

            # 🔹 ACTUALIZAR BD
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

print(" Renombrado completo")