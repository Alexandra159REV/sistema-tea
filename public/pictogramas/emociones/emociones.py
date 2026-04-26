import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\emociones"

    # DICCIONARIO (TU MAPEO DE EMOCIONES)
# 78 elementos
    mapeo = {
    "2245": "aburrido",
    "2314": "preocupado",
    "2367": "enfadado_mucho",
    "2374": "serio",
    "2574": "sorprendido",
    "2606": "triste",
    "3250": "contento",
    "4550": "abrazo",
    "7040": "enfermo_termometro",
    "7272": "pensar_manzana",
    "7273": "pensar_agua",
    "10192": "niña_contenta",
    "10261": "asustado_fantasma",
    "10743": "enfadado_pregunta",
    "10750": "triste_pregunta",
    "11312": "nervioso_espera",
    "11959": "niña_triste",
    "21020": "enfadado_brazos_cruzados",
    "20651": "niña_enfadada",
    "28742": "enfermo_cama",
    "20753": "dolor_cabeza_niño",
    "28754": "dolor_cabeza_niña",
    "28757": "dolor_muela_niño",
    "28758": "dolor_muela_niña",
    "28761": "dolor_garganta_niño",
    "28762": "dolor_garganta_niña",
    "28765": "dolor_barriga_niño",
    "28766": "dolor_barriga_niña",
    "28769": "dolor_espalda_niño",
    "28770": "dolor_espalda_niña",
    "28773": "dolor_brazo_niño",
    "28774": "dolor_brazo_niña",
    "28777": "dolor_oido_niño",
    "28778": "dolor_oido_niña",
    "28781": "dolor_pecho_niño",
    "28782": "dolor_pecho_niña",
    "28785": "dolor_lumbar_niño",
    "28786": "dolor_lumbar_niña",
    "28789": "dolor_gluteo_niño",
    "28790": "dolor_gluteo_niña",
    "30891": "asustado_cara",
    "30620": "mareado_1",
    "31310": "mareado_2",
    "31744": "cara_triste_final",
    "31840": "cara_contenta_final",
    "31871": "niña_enfadada",
    "31884": "niño_enfadado",
    "31925": "niño_mareado",
    "31939": "niño_triste",
    "32148": "dolor_estomago_mujer",
    "32160": "temblar_miedo",
    "32170": "gritar",
    "32296": "enfermo_termometro_niño",
    "34377": "estornudar",
    "34409": "estornudar_mujer",
    "34508": "estornudar_hombre",
    "35529": "cara_sorpresa",
    "35531": "aburrido_cara",
    "35533": "sonrisa",
    "35537": "cara_triste",
    "35539": "cara_enfado",
    "35545": "cara_pena",
    "35559": "pensar_comida",
    "36341": "leer_estudiar",
    "37002": "escala_emociones",
    "37028": "cara_seria",
    "30050": "cara_neutral",
    "30250": "asustado_ruido",
    "38401": "sofoco_calor",
    "30930": "preocupado_niño",
    "30932": "cansado_niño",
    "38936": "meditar_enfado",
    "39142": "prohibido_pelear",
    "39248": "cara_panico",
    "39269": "meditar_relajacion",
    "39564": "dolor_pecho_triste",
    "39668": "asustado_temblor",
    "39056": "sudar_calor",
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