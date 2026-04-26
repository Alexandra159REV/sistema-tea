import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\acciones"

    #  DICCIONARIO (TU MAPEO)
    mapeo = datos_acciones = {
    # Numero : Nombre
    "2369": "dormir",
    "2439": "jugar_pelota",
    "2719": "correr",
    "2782": "ver_television",
    "3251": "caminar",
    "4563": "aplaudir",
    "4738": "saco_de_dormir",
    "5981": "comer_yogur",
    "6044": "caminar_despacio",
    "6465": "correr_rapido",
    "6479": "soñar",
    "6513": "tenis_individual",
    "6514": "tenis_parejas",
    "6537": "jugar_voley",
    "6600": "pareja_amor",
    "6610": "saludo_manos",
    "6626": "mirar_television",
    "7195": "señal_parar",
    "7196": "señal_esperar",
    "7221": "pedir_turno",
    "7296": "mirar_fijamente",
    "8544": "carrera_atletismo",
    "10154": "cruzar_calle",
    "10160": "jugar_golf",
    "10162": "jugar_videojuegos",
    "10163": "jugar_bolos",
    "10369": "duda_pregunta",
    "11225": "zapatear",
    "11226": "sentarse",
    "11536": "beso_amor",
    "11538": "beso_pareja",
    "15507": "lavarse_manos_grifo",
    "16025": "dar_regalo",
    "16739": "ronda_niños",
    "16741": "jugar_equipo",
    "16743": "jugar_futbol",
    "16745": "lavabo_baño",
    "16877": "recibir_regalo",
    "16879": "entregar_paquete",
    "16881": "compartir_juguete",
    "16905": "ver_television_sofa",
    "17038": "entregar_objeto",
    "17040": "recibir_objeto",
    "21583": "echar_crema_solar",
    "23392": "bloques_construccion",
    "24009": "ayudar_persona",
    "24010": "ayudar_niño",
    "24527": "ayudar_silla_ruedas",
    "24551": "correr_niños",
    "24552": "caminar_juntos",
    "25181": "jugar_ajedrez",
    "25182": "jugar_damas",
    "25532": "cocinar_sarten",
    "28295": "jugar_bolos_accion",
    "28425": "descansar_butaca",
    "28431": "pasar_pelota",
    "28439": "correr_rapido_v2",
    "28609": "jugar_tenis_mesa",
    "28623": "dormir_niña",
    "28661": "mirar_television_niña",
    "28833": "dar_dinero",
    "28921": "correr_niños_v2",
    "29123": "ver_television_niño",
    "29124": "ver_tele_lateral",
    "29125": "ver_tele_sentado",
    "29153": "usar_raton",
    "29190": "fuegos_artificiales",
    "29240": "pelear_niños",
    "30480": "dar_moneda",
    "30857": "recoger_moneda",
    "30901": "cinta_correr",
    "31141": "lanzar_pelota",
    "31718": "cambiar_pañal",
    "31719": "dar_biberon",
    "31790": "silla_oficina",
    "31841": "empujar_silla_ruedas",
    "31892": "jugar_voley_v2",
    "31917": "mujer_embarazada",
    "32093": "silla_ruedas_ayuda",
    "32214": "caminar_niño",
    "32218": "bebe_durmiendo",
    "32236": "dormir_cama",
    "32693": "andador_juguete",
    "32694": "carrito_bebe",
    "32908": "caminar_mujer",
    "32944": "usar_andador",
    "32945": "andador_anciano",
    "32946": "usar_baston",
    "33912": "recepcion_hospital",
    "35241": "jugar_tenis",
    "35242": "jugar_bolos_v2",
    "35245": "jugar_golf_v2",
    "35247": "jugar_ajedrez_v2",
    "35361": "baloncesto_niños",
    "35371": "encestar_balon",
    "35411": "dormir_placidamente",
    "37203": "señalar_derecha",
    "37287": "jugar_balonmano",
    "37484": "regatear_futbol",
    "37540": "aplaudir_niño",
    "37608": "jugar_bloques",
    "37768": "jugar_bloques_niña",
    "37855": "cantar_sentado",
    "37950": "cantar_niño",
    "37952": "cantar_niña",
    "37963": "jugar_pelota_silla_rueda",
    "37971": "fronton_niño",
    "37972": "fronton_saque",
    "37973": "fronton_jugador",
    "37975": "fronton_golpe",
    "37982": "caminar_izquierda",
    "37983": "jugar_lacrosse",
    "38467": "correr_cortina",
    "38547": "saludar_mano",
    "38549": "dormir_reloj",
    "38550": "caminar_derecha",
    "38585": "caminar_cinta",
    "38714": "cuna_bebe",
    "39002": "madre_hijo_sofa",
    "39274": "ayudar_anciano",
    "39403": "comer_rapido",
    "39408": "jugar_rayuela",
    "39438": "lanzar_balon_sentado",
    "39439": "equilibrio_barra",
    "39656": "agacharse",
    "39663": "bajar_rampa",
    "39673": "caminar_barra_equilibrio",
    "39675": "equilibrio_un_pie",
    "39682": "voltereta",
    "39683": "rayuela_salto",
    "39835": "recoger_pelota_suelo",
    "39836": "perro_guia",
    "39837": "caminar_campo",
    "39838": "masaje_pie",
    "39839": "jugar_minigolf",
    "39840": "jugar_golf_campo",
    "39841": "jugar_bochas",
    "39842": "estar_sentado",
    "39843": "ponerse_guantes",
    "39844": "fila_niños",
    "39845": "curar_herida",
    "39846": "poner_pomada",
    "39847": "silla_ruedas_rapido",
    "39848": "caminar_persona",
    "39849": "jugar_bolos_niño",
    "39850": "jugar_bolos_niña",
    "39851": "dolor_pecho",
    "39852": "jugar_arena",
    "39853": "saltar_obstaculo",
    "39854": "jugar_barro",
    "39855": "abrazar",
    "39856": "saltar_cuerda",
    "39857": "leer_libro",
    "39858": "escribir_cuaderno",
    "39859": "pintar_pincel",
    "39860": "dibujar_lapiz",
    "39861": "escuchar_musica",
    "39862": "bailar_feliz"
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