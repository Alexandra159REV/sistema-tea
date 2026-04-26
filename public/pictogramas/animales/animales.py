import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\animales"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2294": "caballo",
    "2337": "cisne",
    "2351": "conejo",
    "2372": "elefante",
    "2403": "gallina",
    "2404": "gallo",
    "2405": "gato",
    "2449": "leon",
    "2490": "pajaro",
    "2498": "paloma",
    "2509": "pavo",
    "2517": "perro",
    "2520": "pez",
    "2533": "pollito",
    "2552": "canario",
    "2609": "vaca",
    "2638": "aguila",
    "2650": "avestruz",
    "2671": "buho",
    "2843": "pez_espada",
    "2878": "ganso",
    "2934": "guacamayo",
    "2945": "lechuza",
    "2998": "buitre",
    "3004": "jilguero",
    "3015": "cigueña",
    "3243": "pinguino",
    "3316": "flamenco",
    "3334": "gaviota",
    "3335": "golondrina",
    "3346": "cobaya",
    "3368": "delfin",
    "4619": "cuervo",
    "4657": "gorrion",
    "4766": "urraca",
    "4786": "peces_acuario",
    "5380": "pelicano",
    "6174": "albatros",
    "6245": "colibri",
    "6643": "montar_caballo",
    "6882": "peces_pecera",
    "6923": "gallina_pollitos",
    "6967": "perro_collar",
    "7057": "comida_perro",
    "7058": "comida_gato",
    "7059": "alpiste",
    "7060": "comida_peces",
    "7114": "gata",
    "7199": "sardinas",
    "7201": "perrito_caliente",
    "7202": "perro_marron",
    "8530": "mapa_animales",
    "8711": "pasear_perro",
    "9016": "niña_pasear_perro",
    "9062": "martín_pescador",
    "9063": "cormoran",
    "9072": "pony",
    "9200": "gato_negro",
    "9679": "foca",
    "9801": "silueta_gato",
    "10145": "cepillar_perro",
    "10240": "pinguino_emperador",
    "11176": "perro_sentado",
    "13022": "abubilla",
    "13340": "pavo_real",
    "16900": "tienda_animales",
    "17245": "garza",
    "21380": "mono",
    "24905": "buho_real",
    "25026": "dar_biberon_animal",
    "25125": "gallo_v2",
    "25187": "leona",
    "25293": "paloma_v2",
    "25624": "pollo_asado",
    "25654": "gallinero",
    "25970": "codorniz",
    "25996": "perro_con_correa",
    "26270": "halcon",
    "26271": "aguila_v2",
    "26302": "pasear_perro_v2",
    "26547": "higado",
    "27501": "foca_v2",
    "27625": "montar_caballo_niño",
    "27627": "montar_caballo_niña",
    "27640": "cacatua",
    "27699": "periquito",
    "27780": "pato",
    "27853": "perdiz",
    "27968": "pez_payaso",
    "28477": "pato_v2",
    "28479": "anade",
    "28819": "paloma_torcaz",
    "29690": "pavo_v2",
    "29702": "avestruz_v2",
    "29708": "pasear_perro_v3",
    "29913": "huella_perro",
    "33014": "montar_caballo_v2",
    "33015": "jinete",
    "34041": "perro_cachorro",
    "34075": "gallina_v2",
    "34082": "gato_v2",
    "34143": "perro_v2",
    "34205": "caballo_ajedrez",
    "34294": "acuario_v2",
    "34308": "pajareria",
    "34417": "pez_cirujano",
    "34419": "pez_rojo",
    "34427": "pez_met",
    "34431": "pez_v2",
    "34577": "pez_disco",
    "34583": "caballito_mar",
    "34597": "pez_v3",
    "34850": "buho_v2",
    "35053": "gaviota_v2",
    "35359": "peluquero_canino",
    "35451": "perrera",
    "35483": "amazona",
    "35485": "jinete_v2",
    "35997": "perro_v3",
    "36177": "agility_perro",
    "36424": "perro_silla_ruedas",
    "36986": "condor",
    "37132": "veterinaria",
    "37133": "veterinario",
    "37226": "agility_v2",
    "37317": "esquilar_perro",
    "37588": "pez_v4",
    "37606": "pez_v5",
    "37693": "silueta_animal",
    "37702": "animal_herido",
    "37703": "establo",
    "37704": "perro_guia",
    "37783": "jaula_perro",
    "38141": "peluqueria_canina",
    "38318": "pez_v6",
    "38320": "pez_v7",
    "38324": "pez_v8",
    "38327": "pez_v9",
    "38330": "pez_v10",
    "38333": "pajaro_v2",
    "38341": "pez_v11",
    "38431": "perro_muerto",
    "38506": "collar_perro",
    "38947": "halcon_v2",
    "38967": "perro_v4",
    "38968": "gato_v3",
    "39162": "conejo_pascua",
    "39845": "perro_guia_v2"
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