import os
import mysql.connector

# Configuración de tu base de datos (Laragon)
config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'tea_web' # Asegúrate de que este sea el nombre de tu BD
}

def sincronizar():
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    
    # La ruta donde están todas tus carpetas de imágenes
    ruta_base = r'D:\laragon\www\TEA web\tea-laravel\storage\app\public\pictogramas'
    
    print(" Iniciando sincronización masiva...")

    # Recorremos cada subcarpeta (animales, emociones, etc.)
    for categoria in os.listdir(ruta_base):
        ruta_categoria = os.path.join(ruta_base, categoria)
        
        if os.path.isdir(ruta_categoria):
            for archivo in os.listdir(ruta_categoria):
                if archivo.lower().endswith(('.png', '.jpg', '.jpeg')):
                    # 1. Preparamos los datos
                    titulo = archivo.split('.')[0].replace('_', ' ')
                    ruta_para_bd = f"pictogramas/{categoria}/{archivo}"
                    
                    # 2. Insertamos solo si NO existe ya (para no duplicar)
                    query = """
                        INSERT IGNORE INTO Pictograms (Title, ImagePath, CategoryId) 
                        VALUES (%s, %s, (SELECT Id FROM Categories WHERE Name = %s LIMIT 1))
                    """
                    # Si no tienes las categorías creadas, puedes poner un ID fijo como '1'
                    cursor.execute(query, (titulo, ruta_para_bd, categoria))

    conn.commit()
    print(f" Sincronización terminada Ahora revisa tu página /pictogramas")
    cursor.close()
    conn.close()

if __name__ == "__main__":
    sincronizar()