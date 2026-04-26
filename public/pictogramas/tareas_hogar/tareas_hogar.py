import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\tareas_hogar"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2650": "barrer",
    "2724": "papelera",
    "2816": "regar_planta",
    "2818": "recoger_hojas",
    "2916": "limpiar_mesa",
    "2917": "mesa_circular",
    "3129": "plantar",
    "3143": "limpiar_cristal",
    "3351": "dar_la_mano",
    "4570": "limpiar_polvo",
    "4878": "sacudir_alfombra",
    "4942": "mesa_centro",
    "4943": "mesa_comedor_vacia",
    "4944": "mesa_redonda",
    "5514": "poner_cubitos",
    "5549": "poner_mesa",
    "5558": "quitar_mesa",
    "5569": "cascanueces",
    "6059": "fregar_suelo",
    "6065": "fregar_platos",
    "6562": "sacar_basura",
    "7052": "mesa_madera",
    "8499": "estanteria",
    "8523": "caja_mudanza",
    "8596": "camion_basura",
    "8679": "horno",
    "8680": "basura_organica",
    "8726": "jugar_coche",
    "8727": "limpiar_zapatos",
    "9008": "cepillar_zapatos",
    "9009": "limpiar_ventana",
    "9025": "limpiar_vidrio",
    "9035": "buzon_correo",
    "9072": "limpiar_mueble",
    "10141": "tender_ropa",
    "10315": "hacer_puzzle",
    "11302": "colgar_estanteria",
    "11348": "escoba_recogedor",
    "11363": "mesa_estudio",
    "11385": "apartamento",
    "11386": "caja_juguetes",
    "11751": "tienda_juguetes",
    "11963": "rompecabezas",
    "15469": "empujar_bola",
    "15471": "cepillo_dientes",
    "15479": "dar_objeto",
    "16803": "comer_juntos",
    "16869": "bolsa_reciclaje",
    "16871": "limpiar_espejo",
    "17269": "reparar",
    "17271": "lavar_platos",
    "17298": "cortar_alimentos",
    "17300": "secar_platos",
    "17302": "lavavajillas_vacio",
    "21914": "ordenar_cubiertos",
    "21952": "escurridor",
    "21984": "doblar_ropa",
    "22082": "coser_boton",
    "24312": "planchar_manga",
    "24354": "regar_jardin",
    "24355": "pulverizar",
    "24595": "aspersor",
    "29736": "espantapajaros",
    "29742": "poner_jabon",
    "29746": "secar_manos",
    "29748": "limpiar_con_trapo",
    "29750": "limpiar_ventana_v2",
    "29834": "limpiar_espejo_v2",
    "29835": "limpiar_bidet",
    "30150": "limpiar_oidos",
    "32568": "limpiar_nariz",
    "33998": "curar_herida",
    "34173": "recoger_juguetes",
    "34782": "usar_celular",
    "34801": "limpiar_huerto",
    "36447": "ordenar_escritorio",
    "36542": "limpiar_pizarra",
    "36543": "sacapuntas_lapiz",
    "36661": "cepillar_dientes_v2",
    "36856": "hilo_dental",
    "36858": "productos_limpieza",
    "36861": "poner_guantes",
    "36933": "quitar_guantes",
    "37417": "lavar_manos_v2",
    "37534": "limpiar_alfombra",
    "38000": "cubo_basura",
    "38021": "limpiar_mesa_v2",
    "38030": "desodorante",
    "38071": "servir_comida",
    "38126": "plancha",
    "38129": "tabla_planchar",
    "38206": "limpiar_suelo_v2",
    "38226": "limpiar_polvo_v2",
    "38227": "sacar_bolsa_basura",
    "38289": "recoger_basura_suelo",
    "38363": "recoger_excrementos",
    "38415": "regar_huerto",
    "38459": "escavar",
    "38613": "sembrar",
    "39032": "limpiar_mesa_v3",
    "39033": "mesa_merendero",
    "39034": "sacar_basura_v2",
    "39035": "regar_planta_v2",
    "39046": "contenedor_vidrio",
    "39099": "contenedor_papel",
    "39202": "contenedor_plastico",
    "39450": "contenedor_pilas",
    "39458": "bañar_mascota",
    "39562": "regar_arbol",
    "39636": "cortar_papel",
    "39700": "poner_mesa_v2",
    "39703": "cortar_con_tijeras",
    "39767": "huerto_urbano",
    "39768": "abono_fertilizante",
    "39799": "limpiar_piscina",
    "39764": "fregar_plato_v2",
    "39765": "poner_cubiertos_v2",
    "39766": "lavar_platos_v2",
    "39798": "barrer_v2"
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