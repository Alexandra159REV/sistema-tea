import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\instrumentos_musicales"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2315": "cantar",
    "2318": "castañuelas",
    "2396": "flauta_dulce",
    "2417": "guitarra_española",
    "2463": "maracas",
    "2495": "tambor",
    "2521": "piano",
    "2531": "platillos",
    "2559": "saxofon",
    "2564": "pandereta",
    "2578": "caja",
    "2604": "triangulo",
    "2607": "trompeta",
    "2615": "violin",
    "2616": "xilofono",
    "2717": "coro",
    "2746": "oyente",
    "2778": "musica",
    "2870": "orquesta",
    "2890": "director_coro",
    "3094": "director_orquesta",
    "3256": "bandurria",
    "3266": "pandereta_v2",
    "4585": "tocar_piano",
    "4771": "violonchelo",
    "4922": "bongos",
    "4924": "baquetas",
    "5476": "gaita",
    "5695": "acordeon",
    "5900": "armonica",
    "5909": "bateria",
    "5923": "campana",
    "5938": "metronomo",
    "5949": "oboe",
    "5964": "trompa",
    "5974": "tuba",
    "6233": "trombon",
    "6234": "bombardino",
    "6235": "fagot",
    "6249": "tocar_violin",
    "6567": "teclado",
    "7270": "partitura",
    "8234": "teclado_v2",
    "8315": "maraca",
    "8340": "guiro",
    "8341": "conga",
    "8345": "claves",
    "8364": "platillo_v2",
    "8493": "arpa",
    "8599": "guitarra_electrica",
    "8606": "bateria_v2",
    "8709": "bajo_electrico",
    "9123": "pentagrama_1",
    "9124": "pentagrama_2",
    "9125": "pentagrama_3",
    "9126": "clave_sol",
    "9127": "clave_fa",
    "9128": "clave_do_3",
    "9129": "clave_do_4",
    "9130": "mezclador_dj",
    "9193": "escribir_musica",
    "9201": "atril",
    "9700": "bailarina",
    "11201": "bailarina_v2",
    "11240": "director_banda",
    "11311": "contrabajo",
    "11400": "timbal",
    "17196": "cajon_flamenco",
    "17214": "pandereta_v3",
    "17223": "campanillas",
    "17332": "claves_v2",
    "23777": "baile_flamenco",
    "23811": "tocar_guitarra",
    "23819": "tocar_guitarra_v2",
    "23867": "tocar_saxofon",
    "23897": "tocar_organo",
    "23937": "percusion",
    "24049": "bateria_v3",
    "24091": "notas_musicales",
    "24093": "notas_musicales_v2",
    "24396": "flauta_travesera",
    "24424": "baquetas_v2",
    "24777": "organo",
    "24791": "cornetin",
    "24795": "partituras",
    "25115": "metronomo_v2",
    "25658": "atril_v3",
    "26262": "tocar_instrumento",
    "26286": "escuchar_musica",
    "26933": "escuchar_musica_v2",
    "28553": "cantar_v2",
    "29171": "escuchar_musica_v3",
    "29718": "grupo_musical",
    "29719": "flauta_v2",
    "32015": "marimba",
    "32131": "tambor_v2",
    "32701": "tocar_instrumento_v2",
    "33044": "compositor_1",
    "34027": "compositor_2",
    "34029": "baloncesto_musical",
    "34527": "baloncesto_musical_v2",
    "35023": "voley_musical",
    "35031": "guiro_v2",
    "35057": "clarinete_v2",
    "35371": "oboe_v3",
    "35411": "flauta_v3",
    "35461": "musical_1",
    "35463": "musical_2",
    "35465": "tocar_piano_v2",
    "35467": "instrumentos_viento",
    "35625": "tocar_musica",
    "35626": "escuchar_musica_v4",
    "35641": "percusion_v2",
    "35667": "guitarra_v2",
    "35711": "director_v2",
    "35719": "gong",
    "35051": "timbal_v2",
    "36115": "tambores_v2",
    "36463": "tocar_flauta",
    "36639": "percusion_v3",
    "36669": "guitarra_v3",
    "36670": "partituras_v2",
    "37327": "guitarra_v4",
    "37707": "piano_v3",
    "37807": "metalofono",
    "38000": "djembe_1",
    "38041": "djembe_2",
    "38091": "djembe_3",
    "38096": "oboe_v4",
    "38103": "musicos",
    "38104": "castañuelas_v2",
    "38105": "pandereta_v4",
    "38228": "metalofono_v2",
    "38296": "concierto",
    "38450": "flauta_v4",
    "38453": "bajo_electrico_v2",
    "38455": "palo_lluvia",
    "38464": "laud",
    "38466": "panflauta",
    "38704": "ocarina",
    "38779": "tocar_instrumentos_v3",
    "38784": "atril_v4",
    "38785": "atril_v5",
    "38786": "cd_musica",
    "38948": "xilofono_v2",
    "38984": "acordeon_v2",
    "39020": "melodica",
    "39044": "cuenco_tibetano"
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