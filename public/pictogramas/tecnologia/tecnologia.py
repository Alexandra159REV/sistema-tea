import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\tecnologia"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2354": "consola_videojuegos",
    "2487": "computadora_escritorio",
    "2546": "raton_computadora",
    "2793": "teclado",
    "2820": "raton_clic",
    "5912": "audifono_sordo",
    "5915": "auriculares_grandes",
    "6201": "calculadora",
    "7190": "computadora_torre",
    "7214": "laptop_portatil",
    "8293": "microfono_solapa",
    "9131": "videojuego_pacman",
    "9132": "videojuego_tetris",
    "9160": "pantalla_tactil",
    "9165": "laptop_abierta",
    "9860": "clic_izquierdo",
    "9872": "clic_derecho",
    "11208": "auriculares_diadema",
    "21945": "disco_videojuego",
    "22801": "teclear_escribir",
    "23823": "bateria_pila",
    "25369": "pulsador_raton",
    "25498": "monitor_pantalla",
    "25614": "pelicula_dvd",
    "26186": "usar_raton",
    "28561": "mano_raton",
    "28845": "raton_dibujo",
    "29151": "tablet_jugar",
    "30225": "tablet_contraseña",
    "34621": "pantalla_rota_color",
    "34908": "pantalla_rota_tablet",
    "34910": "prohibido_camara",
    "34939": "cargar_bateria",
    "36357": "auriculares_proteccion",
    "36864": "pantalla_proteccion_monigote",
    "36865": "pantalla_proteccion_mujer",
    "36866": "pantalla_proteccion_hombre",
    "37464": "computadora_mando",
    "37514": "computadora_teclado_raton",
    "38209": "teclado_dispositivo",
    "38333": "cargar_dispositivo",
    "38691": "pantalla_verde_croma",
    "39238": "auriculares_inalambricos",
    "39251": "pantalla_completa",
    "39465": "minimizar_pantalla",
    "39518": "maquina_arcade"
}
    archivos = os.listdir(ruta)

    renombrados = 0
    ya_existen = 0
    faltantes = []

    for archivo in archivos:
        if not archivo.lower().endswith(('.png', '.jpg', '.jpeg')):
            continue

        nombre_original, ext = os.path.splitext(archivo)

        #  LIMPIEZA MÁGICA: Quitamos "arasaac_" si existe para quedarnos solo con el número
        numero = nombre_original.replace("arasaac_", "").strip()

        # Si después de limpiar no es un número, lo saltamos (por si hay otros archivos)
        if not numero.isdigit():
            continue

        if numero in mapeo:
            nuevo_nombre = mapeo[numero] + ext
            origen = os.path.join(ruta, archivo)
            destino = os.path.join(ruta, nuevo_nombre)

            if os.path.exists(destino):
                print(f" Ya existe: {nuevo_nombre}")
                ya_existen += 1
                continue

            try:
                os.rename(origen, destino)
                print(f" {archivo} -> {nuevo_nombre}")
                renombrados += 1
            except Exception as e:
                print(f" Error con {archivo}: {e}")
        else:
            faltantes.append(numero)

    print("\n--- RESUMEN ---")
    print(f" Renombrados: {renombrados}")
    print(f" Ya existían: {ya_existen}")
    print(f" Faltantes: {len(set(faltantes))}")

    #  GENERA AUTOMÁTICAMENTE LOS QUE FALTAN
    if faltantes:
        print("\n--- COMPLETAR DICCIONARIO ---\n")
        for f in sorted(set(faltantes)):
            print(f'"{f}": "",')


if __name__ == "__main__":
    renombrar_imagenes()