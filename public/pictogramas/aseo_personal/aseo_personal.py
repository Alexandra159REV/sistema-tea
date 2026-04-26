import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\aseo_personal"

    #  DICCIONARIO (TU MAPEO)
    mapeo = {
    "2270": "bañador",
    "2271": "bañarse",
    "2326": "lavarse_los_dientes",
    "2371": "ducharse_asistencia",
    "2443": "lavarse_las_manos",
    "2512": "peinarse",
    "2565": "secarse_manos",
    "2566": "secarse_las_manos",
    "2593": "toalla",
    "2693": "peine",
    "2694": "cepillo_de_dientes",
    "2737": "limpieza_dental",
    "2984": "pastilla_jabon",
    "3349": "crema_solar",
    "4758": "toalla_playa",
    "4873": "crema_tubo",
    "5496": "lavadora",
    "5921": "inodoro",
    "5953": "cepillo_uñas",
    "6058": "bañera",
    "6912": "cepillo_pelo",
    "6929": "baño_mujer",
    "6930": "baño_hombre",
    "6971": "sonarse_la_nariz",
    "8084": "cortarse_el_pelo",
    "8094": "jabon_liquido",
    "8616": "lavarse_cara",
    "8975": "ducharse",
    "8976": "lavarse_pelo",
    "8977": "enjuagarse_pelo",
    "9143": "cepillo_electrico",
    "13810": "baño_discapacitados",
    "15905": "baño_completo",
    "25171": "esponja",
    "26803": "ducha_telefono",
    "26947": "cara_limpia",
    "28213": "baño_publico",
    "30086": "poner_pasta_dientes",
    "30614": "hilo_dental",
    "31880": "enjuagarse_boca",
    "32196": "prohibido_baño",
    "32266": "usar_inodoro_mujer",
    "32267": "usar_inodoro_hombre",
    "32683": "polvos_talco",
    "33921": "bidet",
    "34294": "baño_bebe",
    "34775": "lavarse_cara_hombre",
    "34777": "lavarse_cara_niño",
    "35037": "ponerse_jabon",
    "35729": "gel_desinfectante",
    "35977": "lavarse_manos_grifo",
    "36511": "cepillar_pelo_largo",
    "36524": "jabon_pared",
    "36542": "neceser",
    "36552": "cortar_pelo_peluqueria",
    "36558": "maquinilla_pelo",
    "36760": "alcohol_gel",
    "36767": "botiquin_baño",
    "36860": "secarse_manos_aire",
    "36918": "frotarse_manos",
    "37030": "palma_mano",
    "37031": "lavar_dorso_mano",
    "37049": "secarse_con_toalla",
    "37156": "jugar_bañera",
    "37331": "baño_mixto",
    "37409": "jabonera_automatica",
    "37710": "inodoro_discapacitados",
    "37868": "lavabo",
    "37904": "inodoro_niño",
    "37946": "vaso_cepillos",
    "38611": "chorro_agua",
    "38639": "limpiar_lengua",
    "38726": "limpiar_esponja",
    "38782": "nadar",
    "38813": "cepillo_dientes_manual",
    "39211": "poner_jabon_manos",
    "39216": "limpiar_ortodoncia",
    "39766": "lavarse_pelo_asistencia",
    "10381": "perfil",
    "10382": "brazos_atras",
    "10383": "brazos_arriba_curvos",
    "10384": "brazos_arriba_rectos",
    "10385": "manos_nuca",
    "10386": "manos_hombros",
    "10387": "manos_cabeza",
    "11744": "no_cepillar_dientes",
    "11745": "guardar_cepillo",
    "11961": "poner_crema",
    "11963": "abrir_grifo",
    "13042": "sujetar_pantalones",
    "13044": "subir_pantalones",
    "13046": "abotonar",
    "13048": "subir_cremallera",
    "13050": "ajustar_cinturon",
    "13052": "poner_camisa",
    "13054": "abotonar_camisa",
    "13056": "cruzar_brazos",
    "13058": "tocarse_puntas_pies",
    "13060": "brazo_extendido",
    "13062": "brazo_arriba",
    "13064": "brazos_en_jarra",
    "13066": "manos_nuca_ejercicio",
    "13068": "brazos_cruzados_atras",
    "13070": "atención",
    "13072": "manos_caderas",
    "15810": "baño_discapacitados_mujer",
    "15812": "baño_discapacitados_hombre",
    "15814": "baño_discapacitados_mixto",
    "16143": "puerta_baño_mujer",
    "16145": "puerta_baño_hombre",
    "17212": "limpiar_uñas",
    "21840": "escobilla_baño",
    "22029": "lavar_pelo_ducha",
    "23406": "rutina_aseo",
    "25227": "manopla_baño",
    "25843": "nadar_mujer",
    "25844": "nadar_hombre",
    "25845": "nadar_piscina",
    "26744": "cepillo_dientes_infantil",
    "27387": "revisar_calendario",
    "27475": "inodoro_discapacitados",
    "27489": "llorar_baño",
    "27531": "gorro_ducha",
    "27541": "cambiador_bebe",
    "27542": "entrar_baño",
    "27553": "ducha_discapacitados",
    "27555": "ducha_hombre",
    "27557": "ducha_mujer",
    "27559": "inodoro_cerrado",
    "27561": "inodoro_abierto",
    "27695": "cortar_pelo_tijeras",
    "27696": "cortar_pelo_maquinilla",
    "27728": "ducha_asistida",
    "29034": "poner_gel",
    "29036": "cepillo_uñas_limpiar",
    "29040": "lavar_uñas",
    "29052": "toalla_colgada",
    "29210": "poner_jabon_esponja",
    "30087": "poner_pasta_cepillo",
    "30506": "lavar_grifo",
    "30520": "secar_manos_toalla",
    "30524": "cepillo_y_jabon",
    "31853": "bañar_bebe",
    "31951": "prohibido_ducharse",
    "32162": "niño_duchandose",
    "33934": "consulta_medica",
    "33935": "baño_familia",
    "33936": "baño_niños",
    "33954": "lavabo_niños",
    "34611": "lavarse_cara_mujer",
    "36349": "bañarse_tina",
    "36525": "secador_manos_aire",
    "36553": "cortar_pelo_niño",
    "36632": "comer_fruta",
    "36761": "desinfectante_manos",
    "36825": "limpia_pipas",
    "37032": "lavar_palmas",
    "37033": "entrelazar_dedos",
    "37312": "lavar_dedos",
    "37314": "lavar_pulgar",
    "37410": "dispensador_jabon",
    "38053": "brazos_v",
    "38230": "sentarse_inodoro",
    "38242": "medir_presion",
    "38473": "secar_pies",
    "38625": "baño_niños_escuela",
    "38626": "baño_niños_duo",
    "38627": "baño_niños_mixto",
    "39053": "estiramiento",
    "39122": "lavabos_publicos",
    "39446": "ducha_asiento",
    "39447": "lavado_pies_asistido",
    "39448": "lavado_espalda",
    "39449": "lavado_piernas",
    "39556": "limpiar_oidos",
    "39558": "limpiar_nariz",
    "39601": "baño_espuma",
    "39744": "poner_desodorante",
    "40212": "secar_cuerpo_toalla",
    "40214": "enjabonar_cuerpo",
    "41005": "cortar_uñas_manos",
    "41007": "cortar_uñas_pies",
    "42130": "limpiar_gafas",
    "42132": "poner_lentillas",
    "42300": "echar_colirio",
    "42550": "afeitarse_barba",
    "42552": "recortar_barba",
    "43010": "pintar_uñas",
    "43012": "quitar_esmalte"

    
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