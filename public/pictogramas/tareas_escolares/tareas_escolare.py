import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\tareas_escolares"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2348": "pintar_sol",
    "2359": "cuaderno",
    "2380": "escribir_abc",
    "2387": "estudiar_concentrado",
    "2409": "borrador_goma",
    "2440": "lapiz",
    "2450": "libro_cerrado",
    "2475": "mochila",
    "3082": "colegio_escuela",
    "4696": "mochila_senderismo",
    "4965": "tizas_pizarra",
    "6454": "biblioteca",
    "6474": "sacar_libro_estanteria",
    "6495": "estudiar_biblioteca",
    "6641": "fichas_educativas",
    "6874": "abrir_libro",
    "7004": "leer_cuento",
    "7141": "escribir_pizarra",
    "8107": "guardar_en_mochila",
    "8165": "sacar_de_mochila",
    "8216": "mochila_escolar",
    "9060": "leer_recetario",
    "9080": "memoria_usb",
    "9220": "libro_naturaleza",
    "9223": "maletin",
    "10312": "escribir_lapiz",
    "11371": "sentarse_en_circulo",
    "11372": "reunion_circulo",
    "12297": "leer_braille",
    "16155": "señalar_libro",
    "16341": "borrador_pizarra",
    "16799": "pasaporte",
    "21851": "teclado_computadora",
    "24615": "arquitecto_planos",
    "24771": "entregar_libro",
    "25191": "libro_abierto",
    "26589": "familia_paseo",
    "27260": "sentarse_borde_piscina",
    "27269": "sentarse_borde_piscina_niño",
    "27270": "sentarse_perfil",
    "27411": "rellenar_formulario",
    "28643": "leer_niña",
    "29853": "recoger_juguetes",
    "29907": "aula_musica",
    "29911": "aula_idiomas",
    "29917": "aula_ciencias",
    "30872": "profesora_clase_2",
    "30873": "profesor_clase_2",
    "30874": "profesora_clase_1",
    "30875": "profesor_clase_1",
    "30876": "cura_clase_1",
    "30877": "monja_clase_1",
    "30878": "cura_clase_2",
    "30879": "monja_clase_2",
    "31680": "leer_niño_color",
    "32308": "duda_lectura",
    "32446": "aula_vacia",
    "32814": "estudiar_examen",
    "34782": "ordenar_escritorio",
    "34790": "dar_clase_pizarra",
    "35979": "estudiar_cansado",
    "36257": "buscar_en_diccionario",
    "36447": "sacapuntas_lapiz",
    "37093": "computadora_escritorio",
    "37189": "sacar_punta",
    "37225": "clase_musica_pizarra",
    "37358": "huella_digital_lector",
    "37406": "firmar_documento",
    "37407": "marcar_opcion",
    "37518": "mochila_puesta_bien",
    "37519": "mochila_puesta_mal",
    "37896": "colgar_mochila",
    "38265": "mochila_espalda",
    "38610": "ordenar_libros",
    "38612": "carpeta_anillas",
    "38695": "cerrar_mochila",
    "38700": "abrir_mochila",
    "39018": "escanear_codigo_qr",
    "39115": "mochila_en_suelo",
    "39661": "patio_recreo",
    "39687": "leer_atentamente",
    "39688": "maleta_viaje"
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