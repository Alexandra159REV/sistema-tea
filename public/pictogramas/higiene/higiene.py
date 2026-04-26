import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\higiene"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2271": "bañarse_bebe",
    "2371": "ducha_niño",
    "8977": "lavarse_manos_niño",
    "2512": "peinarse_niño",
    "2566": "secarse_manos_toalla",
    "2593": "toalla_colgada",
    "2694": "barrer_escoba",
    "2695": "cepillo_dientes",
    "2699": "cepillo_pelo",
    "2928": "bote_jabon",
    "2964": "mano_abierta",
    "3351": "pastilla_jabon",
    "4758": "secarse_manos_papel",
    "4873": "toalla_playa",
    "4878": "crema_tubo",
    "5496": "plumero_limpiar",
    "5609": "lavadora",
    "5953": "cepillo_uñas",
    "6058": "cepillo_ropa",
    "6912": "bañarse_adulto",
    "6971": "peine_y_jabon",
    "7049": "hacer_pompas",
    "8094": "mascarilla_facial",
    "8389": "enjuagarse_boca",
    "8616": "dispensador_jabon",
    "8726": "soplador_pompas",
    "8727": "lavarse_cara",
    "8975": "ponerse_gafas",
    "8976": "limpiar_zapato",
    "9977": "lavarse_manos_adulto",
    "9008": "lavarse_pelo",
    "9009": "enjuagarse_pelo",
    "9143": "limpiar_ventana",
    "9830": "limpiar_espejo",
    "10137": "cepillo_electrico",
    "10267": "manos_sucias",
    "10372": "manos_limpias",
    "10373": "muela_limpia",
    "10374": "ejercicio_brazos_cintura",
    "10375": "ejercicio_brazos_pecho",
    "10376": "ejercicio_brazos_abajo",
    "10377": "ejercicio_brazos_juntos",
    "10378": "ejercicio_brazos_estirados",
    "10379": "ejercicio_brazos_nuca",
    "10380": "ejercicio_brazos_cruzados",
    "10381": "ejercicio_brazos_hombros",
    "10382": "estiramiento_espalda",
    "10383": "ejercicio_brazos_arriba",
    "10384": "ejercicio_brazos_flexion",
    "10385": "ejercicio_brazos_rectos",
    "10386": "ejercicio_manos_cintura",
    "10387": "ejercicio_manos_cadera",
    "11744": "ejercicio_manos_nuca_2",
    "11745": "ejercicio_manos_arriba_2",
    "11963": "prohibido_cepillar",
    "13042": "colgar_toalla",
    "13044": "limpiar_cepillo",
    "13046": "ejercicio_manos_cintura",
    "13048": "ejercicio_brazos_cintura",
    "13050": "ejercicio_brazos_pecho",
    "13052": "ejercicio_brazos_frente",
    "13054": "ejercicio_brazos_abajo",
    "13056": "ejercicio_brazos_juntos",
    "13058": "ejercicio_brazos_estirados",
    "13060": "ejercicio_brazos_nuca",
    "13062": "ejercicio_brazos_cruzados",
    "13064": "estiramiento_espalda",
    "13066": "ejercicio_manos_espalda",
    "13068": "ejercicio_brazos_arriba",
    "13070": "ejercicio_brazos_flexion",
    "13072": "ejercicio_brazos_rectos",
    "15736": "lavadora",
    "15810": "baño_discapacitados_1",
    "15812": "baño_discapacitados_2",
    "15814": "baño_discapacitados_3",
    "16803": "limpiar_espejo",
    "17269": "limpiar_tabla",
    "17271": "secarse_cara",
    "21962": "limpiar_cepillo",
    "22029": "peinarse_pelo_largo",
    "23405": "pasos_lavado_pelo",
    "25171": "jabon_en_jabonera",
    "25843": "bañarse_piscina_mujer",
    "25844": "bañarse_piscina_niño",
    "25845": "bañarse_piscina_hombre",
    "26744": "cepillo_electrico_mano",
    "26803": "ducha_lateral",
    "26947": "lavar_pelo_niño",
    "27475": "inodoro_discapacitados",
    "27489": "cepillarse_dientes_niña",
    "27559": "baño_hombre",
    "27561": "baño_mujer",
    "27720": "lavarse_pelo_ducha",
    "27869": "orinar_niña",
    "27071": "limpiar_zapato_betun",
    "28213": "baño_mixto",
    "29034": "ponerse_crema_manos",
    "29036": "cepillo_uñas_azul",
    "29052": "secarse_manos_toalla_verde",
    "29210": "jabon_liquido_mano",
    "29736": "limpiar_gafas",
    "29746": "limpiar_ventana_mujer",
    "29748": "limpiar_espejo_mujer",
    "29750": "orinar_niño",
    "29834": "limpiar_oido_bastoncillo",
    "29835": "gotas_oido",
    "30150": "poner_curita",
    "30508": "lavarse_manos_jabon",
    "30520": "secarse_manos_toalla_verde_2",
    "30524": "bote_jabon_y_peine",
    "30614": "pasta_y_cepillo_dientes",
    "31853": "bañar_bebe_bañera",
    "31880": "lavarse_dientes_niño",
    "32162": "ducha_niño",
    "32576": "aseo_cuerpo",
    "33921": "jabon_jabonera",
    "33924": "dispensador_papel",
    "33934": "baño_clinica",
    "33935": "baño_discapacitados",
    "33936": "baño_mixto",
    "34294": "lavar_verdura",
    "34611": "bañarse_sentado",
    "34775": "lavarse_cara_mujer",
    "34777": "lavarse_cara_niño",
    "34826": "lavarse_cara_manos",
    "35037": "secarse_pelo",
    "35405": "lavar_pelo_niña",
    "35729": "muela_limpia",
    "35977": "dispensador_jabon_1",
    "36349": "dispensador_jabon_2",
    "36511": "peine_neceser",
    "36524": "lavar_pelo_peluqueria",
    "36525": "inodoro_niña",
    "36542": "inodoro_niño",
    "36552": "orinar_hombre",
    "36555": "jabon_liquido_1",
    "36652": "jabon_liquido_2",
    "36653": "biberon_bebe",
    "36760": "escobilla_baño",
    "36761": "lavarse_manos_1",
    "36825": "lavarse_manos_2",
    "36860": "secarse_pies",
    "36918": "ponerse_crema_pie",
    "36933": "secarse_manos_aire",
    "37030": "lavarse_manos_palmas",
    "37031": "lavarse_manos_dorso",
    "37032": "lavarse_manos_uñas",
    "37033": "lavarse_manos_dedos",
    "37263": "piscina_inflable",
    "37312": "manos_limpias",
    "37314": "manos_entrelazadas",
    "37331": "baño_hombres_mujeres",
    "37384": "limpiar_ombligo",
    "37401": "inodoro_limpiar",
    "37402": "inodoro_abierto",
    "37409": "dispensador_papel_vertical",
    "37410": "prohibido_jabon",
    "37710": "inodoro_lateral",
    "37811": "limpiar_espejo",
    "37866": "lavarse_manos_infantil",
    "37904": "inodoro_discapacitados_mujer",
    "38053": "levantar_brazos",
    "38230": "desodorante_rollon",
    "38242": "tensiometro",
    "38409": "niño_inodoro_ayuda",
    "38541": "neceser_azul",
    "38611": "lavar_pies",
    "38625": "baño_niños",
    "38626": "baño_niñas",
    "38627": "inodoro_infantil_1",
    "38726": "inodoro_infantil_2",
    "38813": "limpiar_mueble",
    "39053": "cepillo_dientes_rojo",
    "39202": "limpiar_oreja",
    "39211": "usar_pañuelo",
    "39216": "toallitas_humedas",
    "39766": "dentista_revision",
    "3368": "cortar_pelo",
    "4619": "tirar_cadena"
    
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