import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\animales"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
   "2276": "beber",
    "2329": "cerezas",
    "2349": "comer",
    "2400": "fresa",
    "2445": "leche",
    "2462": "manzana",
    "2468": "melocoton",
    "2469": "melon",
    "2483": "naranja",
    "2494": "pan",
    "2525": "piña",
    "2530": "platano",
    "2532": "plato",
    "2557": "sandia",
    "2561": "pera",
    "2610": "vaso",
    "2675": "verter",
    "2703": "uvas",
    "2865": "pan_de_molde",
    "2874": "aceitunas_verdes",
    "2875": "aceitunas_negras",
    "2906": "frambuesas",
    "2955": "kiwi",
    "2979": "higo",
    "2983": "albaricoque",
    "3022": "limon",
    "3247": "uvas_verdes",
    "3327": "fruteria",
    "3328": "frutero_vendedor",
    "4653": "frutero_recipiente",
    "4695": "imagen_galeria",
    "4768": "vaso_de_agua",
    "4769": "vaso_de_leche",
    "4940": "mermelada",
    "5537": "pelar_fruta",
    "5931": "brocheta_fruta",
    "6061": "beber_pajita",
    "6456": "fresa_v2",
    "6508": "manzana_roja",
    "6509": "beber_biberon",
    "6971": "bebe_comiendo",
    "7219": "ensalada",
    "7240": "carne_cruda",
    "7247": "servir_bebida",
    "7292": "cortar_pan",
    "7763": "ketchup",
    "8009": "aguacate",
    "8303": "cereza_v2",
    "8305": "ciruela",
    "8316": "mora_negra",
    "8317": "aceituna_v2",
    "8360": "mora_azul",
    "8540": "chirimoya",
    "8594": "granada",
    "8616": "lavar_manos",
    "8673": "prohibido_tocar",
    "8674": "prohibido_fumar",
    "8684": "limon_v2",
    "8730": "naranja_v2",
    "8975": "lavar_cabeza",
    "8976": "lavar_cuerpo",
    "8977": "lavar_manos_v2",
    "9054": "platano_v2",
    "9059": "untar_pan",
    "10149": "cortar_verdura",
    "10150": "cortar_carne",
    "10218": "platano_v3",
    "10224": "coco",
    "10228": "galletas",
    "10230": "vaso_leche_v2",
    "10232": "pan_v2",
    "10235": "limon_v3",
    "11227": "datiles",
    "11269": "puesto_fruta",
    "11298": "mandarina",
    "13034": "arandanos",
    "13074": "nispero",
    "13084": "frambuesas_v2",
    "13352": "pomelo",
    "13644": "manzana_verde",
    "13645": "manzana_amarilla",
    "15453": "lima",
    "16303": "champiñones",
    "16813": "albaricoque_v2",
    "16829": "papaya",
    "16857": "plato_v2",
    "17292": "platano_v4",
    "25185": "leche_formula",
    "25237": "cafe",
    "27489": "beber_agua_v2",
    "27776": "comer_v2",
    "28339": "frutas_variadas",
    "28413": "comer_bocadillo",
    "28414": "comer_galleta",
    "28415": "comer_pan",
    "28521": "mandarina_v2",
    "28641": "comer_fruta",
    "29012": "tortitas",
    "29177": "prohibido_bebida",
    "29179": "prohibido_comida",
    "29191": "carne_picada",
    "29220": "cuchillo",
    "29716": "pan_integral",
    "29808": "pan_v3",
    "29993": "tienda_comestibles",
    "31880": "comer_sopa",
    "34008": "leche_v3",
    "34045": "platano_v5",
    "34088": "plato_v3",
    "34120": "uvas_v2",
    "34151": "hamburguesa",
    "34611": "lavar_cara",
    "34775": "lavar_cara_v2",
    "34777": "lavar_cara_v3",
    "34826": "lavar_manos_v3",
    "35037": "lavar_pelo",
    "35145": "frutas_v3",
    "35159": "pelar_platano",
    "35607": "batido_leche",
    "35657": "bol_fruta",
    "36153": "melon_v2",
    "36344": "patatas_cocidas",
    "36402": "huevo",
    "36469": "pan_v4",
    "36488": "fruta_azul",
    "36515": "carne_v2",
    "36540": "fresa_v3",
    "36586": "pan_v5",
    "36655": "plato_v4",
    "36944": "pan_v6",
    "36965": "masa_pan",
    "36988": "cocinar",
    "37058": "caja_fruta_v2",
    "37272": "vaso_v2",
    "37505": "puerro",
    "37508": "nispero_v2",
    "37509": "caqui",
    "37528": "biberon",
    "37592": "batido_v2",
    "37599": "cerezas_v3",
    "37642": "filete",
    "37841": "pan_v7",
    "37842": "fruta_cortada",
    "37881": "baguette",
    "38011": "beber_agua_v3",
    "38012": "rosquilla",
    "38230": "persona_comiendo",
    "38242": "tensio_arterial",
    "38397": "mojar_pan",
    "38413": "persona_bebiendo",
    "38494": "uvas_v3",
    "38505": "vaso_v3",
    "38525": "pan_v8",
    "38611": "lavar_pies",
    "38671": "tienda_fruta",
    "38707": "pastel",
    "38723": "pan_v9",
    "38726": "limpiar_mesa",
    "38732": "pan_v10",
    "38733": "pan_v11",
    "38743": "fruta_congelada",
    "38965": "baguettes",
    "38982": "lavar_manos_v4",
    "38983": "lavar_manos_v5",
    "39083": "beber_agua_v4",
    "39093": "melocoton_v2",
    "39105": "maracuya",
    "39536": "palomitas",
    "39584": "pate",
    "39590": "pan_v12",
    "39614": "limon_v4",
    "39629": "kiwi_v2",
    "39630": "chirimoya_v2",
    "39631": "pelar_platano_v2",
    "39691": "calabacin"
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