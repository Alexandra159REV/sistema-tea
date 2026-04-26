import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\jardineria"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2256": "arbol",
    "2331": "setas",
    "2361": "cubo_y_pala",
    "2434": "parque",
    "2666": "bosque",
    "2867": "pala",
    "2981": "acelga",
    "2996": "puerro",
    "3051": "abeto",
    "3052": "acebo",
    "3057": "arbol_v2",
    "3070": "cactus",
    "3079": "hoja",
    "3080": "clavel",
    "3102": "flor",
    "3113": "hierba",
    "3114": "margarita_v2",
    "3122": "limonero",
    "3126": "planta",
    "3127": "margarita",
    "3138": "palmera",
    "3144": "platanero",
    "3148": "raiz",
    "3151": "rosa",
    "3159": "tallo",
    "3160": "tierra",
    "3163": "tulipan",
    "3174": "almendro",
    "3194": "cerezo",
    "3195": "ciruelo",
    "3198": "cocotero",
    "3201": "higuera",
    "3203": "manzano",
    "3205": "naranjo",
    "3211": "olivo",
    "3214": "peral",
    "3216": "pino",
    "3219": "sauce_lloron",
    "3318": "vivero",
    "3319": "fruteria",
    "3386": "seta",
    "4846": "baqueta",
    "5062": "arbol_invierno",
    "5063": "arbol_otoño",
    "5076": "hoja_marron",
    "5077": "hoja_verde",
    "5460": "espinacas",
    "6040": "caña_azucar",
    "6503": "amapola_v2",
    "6504": "amapola",
    "6897": "flor_v2",
    "6911": "trigo",
    "6921": "avena",
    "6967": "cebada",
    "7104": "margarita_v3",
    "7105": "clavel_v2",
    "7153": "flor_marchita",
    "7224": "rama",
    "7245": "sembrar",
    "7281": "trebol",
    "7803": "espiga",
    "7804": "ramo_flores",
    "7819": "tronco",
    "8056": "petunia",
    "8157": "geranio",
    "8328": "niscalo",
    "8512": "bonsai",
    "8585": "nenufar",
    "8601": "helecho",
    "8614": "hoja_v2",
    "8668": "piña_pino",
    "8689": "semilla",
    "9142": "mimosa",
    "10220": "champiñon",
    "10250": "perro_guia",
    "11202": "capullo",
    "11214": "cesped",
    "11265": "jardinera",
    "11272": "geranio_v2",
    "11274": "girasol",
    "11309": "maceta_v2",
    "11310": "macetas",
    "11321": "orquidea",
    "11322": "caña",
    "11334": "perejil",
    "11395": "pensamiento",
    "11397": "regadora",
    "11572": "cactus_v2",
    "11590": "madroño",
    "14242": "lavanda",
    "14244": "romero",
    "14246": "tomillo",
    "14248": "manzanilla",
    "17103": "planton",
    "21413": "bambu",
    "21894": "albahaca",
    "21902": "azafran",
    "23701": "papiro",
    "23913": "yuca",
    "23991": "cipres",
    "24537": "sauce",
    "25650": "seto",
    "25853": "arbusto",
    "25894": "calas",
    "26067": "lechuga_v2",
    "26310": "pensamiento_v2",
    "26381": "huerto",
    "28567": "narciso",
    "28571": "hojas_otoño",
    "28725": "enredadera",
    "28843": "cactus_v3",
    "28849": "castaño",
    "28853": "avellano",
    "28857": "nogal",
    "28861": "muerdago",
    "29772": "lirio",
    "29855": "plantas_v2",
    "30014": "planeta_tierra",
    "30241": "monte",
    "30522": "rosal",
    "30608": "jardin",
    "30609": "parque_v2",
    "32462": "arboleda",
    "32685": "tuna",
    "32687": "algodon",
    "32738": "gota_resina",
    "32741": "eucalipto",
    "33010": "raqueta_badminton",
    "33988": "invernadero",
    "34043": "tulipanes",
    "34053": "semilla_v2",
    "34175": "encina",
    "34223": "pino_v2",
    "34229": "rama_pino",
    "34543": "pala_y_rastrillo",
    "34753": "chopo",
    "35367": "palmeras",
    "35399": "arbol_v3",
    "35753": "trufa",
    "35755": "rucula",
    "36287": "maiz",
    "36340": "celula_vegetal",
    "36359": "chumbera",
    "36394": "flor_pascua",
    "36921": "semilla_germina",
    "37009": "raiz_v2",
    "37013": "ficus",
    "37114": "junco",
    "37131": "arbol_v4",
    "37145": "antera",
    "37147": "estambre",
    "37148": "estigma",
    "37149": "ovulo",
    "37150": "pistilo",
    "37151": "polen",
    "37152": "sepalo",
    "37153": "caliz",
    "37168": "corola",
    "37169": "petalo",
    "37171": "fotosintesis",
    "37584": "azalea",
    "37585": "iris",
    "37598": "acelgas",
    "37602": "mortero",
    "37676": "baobab",
    "37691": "espiga_trigo",
    "37722": "malva",
    "37869": "granado",
    "37986": "urbanizacion",
    "38002": "abeto_v2",
    "38070": "flores_silvestres",
    "38254": "azada",
    "38268": "bellota",
    "38269": "calendula",
    "38526": "ajenuz",
    "38527": "sesamo",
    "38624": "violetas",
    "38767": "floristería",
    "38795": "manzanilla_v2",
    "38806": "frutales",
    "38970": "bellota_v2",
    "39007": "espina",
    "39101": "rosas",
    "39192": "hierbas_aromaticas",
    "39291": "sesamo_v2",
    "39389": "cilantro",
    "39390": "buganvilla",
    "39391": "peral_v2",
    "39404": "albaricoquero",
    "39468": "moho",
    "39541": "aloe_vera",
    "39651": "champiñones",
    "39671": "arbol_v5",
    "39811": "corteza"
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