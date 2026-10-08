import os
import mysql.connector

# Conexión a tu base de datos de Laragon
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="tea_web"
)
cursor = db.cursor()

# Ruta donde están tus carpetas (emociones, comida, animales, etc.)
ruta_base = r'D:\laragon\www\TEA web\tea-laravel\public\storage\pictogramas'

print(" Escaneando carpetas de pictogramas...")

# Recorremos cada subcarpeta
for carpeta in os.listdir(ruta_base):
    ruta_completa_carpeta = os.path.join(ruta_base, carpeta)
    
    if os.path.isdir(ruta_completa_carpeta):
        print(f" Procesando categoría: {carpeta}")
        
        for archivo in os.listdir(ruta_completa_carpeta):
            if archivo.lower().endswith(('.png', '.jpg', '.jpeg')):
                # Limpiar el nombre para el título
                titulo = archivo.split('.')[0].replace('_', ' ')
                # Ruta que usará Laravel
                ruta_final = f"pictogramas/{carpeta}/{archivo}"
                
                # INSERT IGNORE evita que se dupliquen si vuelves a correr el script
                sql = "INSERT IGNORE INTO Pictograms (Title, ImagePath, CategoryId) VALUES (%s, %s, %s)"
                cursor.execute(sql, (titulo, ruta_final, 1)) # Usamos 1 por defecto

db.commit()
print(f" ¡Sincronización completa! Se han registrado todas las imágenes en la base de datos.")
cursor.close()
db.close()