import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\social"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2439": "jugar_con_pelota_niños",
    "2474": "mirar_ver",
    "2746": "escuchar_oir",
    "4959": "semaforo",
    "5358": "direccion_flecha",
    "5441": "lanzar_pelota",
    "5508": "jugar_con_bloques",
    "5526": "prohibido_no",
    "5584": "correcto_si",
    "5896": "saludar",
    "6009": "niña_saludando",
    "6028": "persona_saludando",
    "6155": "no_gritar",
    "6156": "no_correr_no_cruzar",
    "6481": "detras_de_alguien",
    "6513": "jugar_tenis_saque",
    "6514": "jugar_tenis_derecha",
    "6522": "saludar_de_mano",
    "6537": "jugar_con_pelota_equipo",
    "6564": "pensar",
    "6572": "escuchar_atentamente",
    "6600": "pareja_amor",
    "7029": "seguir_a_alguien",
    "7031": "dos_personas_paradas",
    "7033": "tres_personas_paradas",
    "7076": "señalar",
    "7171": "gritar_asustado",
    "7179": "no_pelear",
    "7180": "confundido_no_saber",
    "7221": "jugar_voleibol",
    "7253": "grupo_de_personas",
    "8109": "entrar_a_clase_escuela",
    "8128": "sentirse_bien_satisfecho",
    "8129": "estar_feliz_orgulloso",
    "8194": "rezar_pedir",
    "8195": "rogar_pedir_por_favor",
    "8485": "no_saltar",
    "9034": "jugar_golf",
    "10160": "jugar_videojuegos_consola",
    "10162": "jugar_boliche_bowling",
    "10163": "jugar_en_equipo",
    "11315": "reunion_de_tres_personas",
    "11536": "beso_pareja",
    "11538": "beso_niñas",
    "11595": "no_tocar_prohibido",
    "11625": "triste_solo",
    "12252": "ayudar_dar_la_mano",
    "15361": "compartir_juguetes",
    "15507": "lavarse_las_mano",
    "16125": "preguntar_duda",
    "16623": "dar_algo_a_alguien",
    "16697": "entrar_a_una_habitacion",
    "16739": "jugar_en_ronda",
    "16741": "abrazar",
    "16743": "jugar_futbol",
    "16745": "lavar_platos",
    "16885": "leer_en_un_escritorio",
    "19524": "desesperacion_manos_a_la_cabeza",
    "22005": "conducir_volante",
    "22775": "silla_de_ruedas",
    "23392": "jugar_con_juguetes_en_el_suelo",
    "24497": "beber_agua_grifo",
    "24653": "no_entrar",
    "25077": "esperar_el_bus_parada",
    "25078": "subir_al_bus",
    "25181": "jugar_ajedrez_dos_personas",
    "25182": "jugar_ajedrez_tablero",
    "25620": "jugar_con_piezas_geometricas",
    "25716": "no_mirar_no_ver",
    "25776": "grupo_caminando",
    "26405": "levantar_la_mano_en_clase",
    "27363": "hablar_conversar",
    "27541": "ayudar_a_persona_en_silla_de_ruedas",
    "27542": "salir_de_una_habitacion",
    "27547": "sentarse_en_fila_cine_teatro",
    "28295": "jugar_baloncesto",
    "28359": "ojo_vision_lateral",
    "28429": "cruzar_los_brazos_prohibido",
    "28609": "jugar_voleibol_de_playa",
    "28659": "tocar_la_oreja_escuchar",
    "28673": "mirar_hacia_adelante",
    "28677": "abrir_la_puerta",
    "29151": "jugar_con_tablet",
    "29153": "mirar_television",
    "29718": "escuchar_perfil",
    "29719": "escuchar_musica_niña",
    "29720": "escuchar_musica_niño",
    "31141": "lanzar_pelota",
    "31206": "comer_niña",
    "31664": "levantar_manos",
    "31670": "mirar_niños",
    "31760": "prohibido_comer",
    "31906": "estar_de_pie",
    "32131": "escuchar_radio_niño",
    "32308": "leer_libro",
    "32753": "hacer_pesas",
    "32814": "estudiar_escribir",
    "32862": "pensar_compartir_ideas",
    "33998": "usar_celular",
    "34467": "saludar_espalda",
    "34567": "saludar_frente",
    "35187": "cruzar_torniquete",
    "35241": "jugar_tenis_niño",
    "35242": "jugar_tenis_niña",
    "35245": "jugar_bolos_niña",
    "35247": "jugar_golf_niña",
    "35361": "jugar_ajedrez",
    "35428": "jugar_damas",
    "35717": "tenis_silla_ruedas",
    "35719": "escuchar_musica_silla",
    "35723": "baloncesto_silla_ruedas",
    "35741": "escuchar_radio_monigote",
    "35749": "jugar_baloncesto",
    "36093": "amar_querer",
    "36259": "oler_flor",
    "36333": "hablar_cara_a_cara",
    "36391": "esperar_fila_niños",
    "36518": "lanzar_pelota_monigote",
    "36545": "jugar_futbol",
    "36845": "subir_autobus_niño",
    "36884": "subir_autobus_niña",
    "36885": "bajar_autobus",
    "36912": "autobus_rampa",
    "36913": "interior_autobus",
    "36914": "esperar_parada",
    "36915": "entrar_autobus",
    "36917": "ascensor",
    "37055": "rezar",
    "37066": "amamantar",
    "37067": "dar_biberon",
    "37068": "jugar_bebe",
    "37097": "dormir_litera",
    "37100": "futbol_americano",
    "37101": "mover_cabeza_lados",
    "37162": "elegir_opcion",
    "37184": "hacer_fila",
    "37187": "aseos_baños",
    "37194": "sala_espera",
    "37486": "escuchar_auriculares",
    "37487": "ventana_tren",
    "37768": "ayudar_silla_ruedas",
    "37825": "pulgar_abajo_triste",
    "37827": "pensar_duda",
    "37855": "comer_sopa",
    "37922": "mirarse_espejo",
    "37950": "jugar_rayuela_niña",
    "37952": "jugar_pelota_sentados",
    "37982": "jugar_rayuela_niño",
    "37983": "jugar_rayuela_monigote",
    "38360": "sentir_corazon_niña",
    "38361": "sentir_corazon_niño",
    "38406": "esperar_tren",
    "38408": "andén_estacion",
    "38410": "esperar_autobus",
    "38547": "jugar_minigolf",
    "38548": "jugar_golf_niño",
    "38549": "jugar_petanca",
    "38888": "triste_niña",
    "38890": "triste_niño",
    "38900": "dar_regalo",
    "38907": "pedir_por_favor",
    "38944": "mesa_trabajo",
    "39001": "escuela_colegio",
    "39012": "correcto_incorrecto",
    "39049": "estudiar_mesa",
    "39062": "sentarse_esperar",
    "39149": "dudar_no_saber",
    "39157": "escuchar_audio",
    "39247": "sentarse_suelo_triste",
    "39438": "jugar_bolos_monigote",
    "39439": "jugar_bolos_color",
    "39663": "jugar_arena",
    "39673": "jugar_canicas",
    "39675": "jugar_barro",
    "39713": "dar_vueltas"
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