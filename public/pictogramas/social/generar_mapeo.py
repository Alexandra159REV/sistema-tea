import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2439", "2474", "2746", "4959", "5358", "5441", "5508", "5526", "5584", "5896",
    "6009", "6028", "6155", "6156", "6481", "6513", "6514", "6522", "6537", "6564",
    "6572", "6600", "7029", "7031", "7033", "7076", "7171", "7179", "7180", "7221",
    "7253", "8109", "8128", "8129", "8194", "8195", "8485", "9034", "10160", "10162",
    "10163", "11315", "11536", "11538", "11595", "11625", "12252", "15361", "15507", "16125",
    "16623", "16697", "16739", "16741", "16743", "16745", "16885", "19524", "22005", "22775",
    "23392", "24497", "24653", "25077", "25078", "25181", "25182", "25620", "25716", "25776",
    "26405", "27363", "27541", "27542", "27547", "28295", "28359", "28429", "28609", "28659",
    "28673", "28677", "29151", "29153", "29718", "29719", "29720", "31141", "31206", "31664",
    "31670", "31760", "31906", "32131", "32308", "32753", "32814", "32862", "33998", "34467",
    "34567", "35187", "35241", "35242", "35245", "35247", "35361", "35428", "35717", "35719",
    "35723", "35741", "35749", "36093", "36259", "36333", "36391", "36518", "36545", "36845",
    "36884", "36885", "36912", "36913", "36914", "36915", "36917", "37055", "37066", "37067",
    "37068", "37097", "37100", "37101", "37162", "37184", "37187", "37194", "37486", "37487",
    "37768", "37825", "37827", "37855", "37922", "37950", "37952", "37982", "37983", "38360",
    "38361", "38406", "38408", "38410", "38547", "38548", "38549", "38888", "38890", "38900",
    "38907", "38944", "39001", "39012", "39049", "39062", "39149", "39157", "39247", "39438",
    "39439", "39663", "39673", "39675", "39713"
]

nombres = [
    "jugar_con_pelota_niños", "mirar_ver", "escuchar_oir", "semaforo", "direccion_flecha", "lanzar_pelota", "jugar_con_bloques", "prohibido_no", "correcto_si", "saludar",
    "niña_saludando", "persona_saludando", "no_gritar", "no_correr_no_cruzar", "detras_de_alguien", "jugar_tenis_saque", "jugar_tenis_derecha", "saludar_de_mano", "jugar_con_pelota_equipo", "pensar",
    "escuchar_atentamente", "pareja_amor", "seguir_a_alguien", "dos_personas_paradas", "tres_personas_paradas", "señalar", "gritar_asustado", "no_pelear", "confundido_no_saber", "jugar_voleibol",
    "grupo_de_personas", "entrar_a_clase_escuela", "sentirse_bien_satisfecho", "estar_feliz_orgulloso", "rezar_pedir", "rogar_pedir_por_favor", "no_saltar", "jugar_golf", "jugar_videojuegos_consola", "jugar_boliche_bowling",
    "jugar_en_equipo", "reunion_de_tres_personas", "beso_pareja", "beso_niñas", "no_tocar_prohibido", "triste_solo", "ayudar_dar_la_mano", "compartir_juguetes", "lavarse_las_mano", "preguntar_duda",
    "dar_algo_a_alguien", "entrar_a_una_habitacion", "jugar_en_ronda", "abrazar", "jugar_futbol", "lavar_platos", "leer_en_un_escritorio", "desesperacion_manos_a_la_cabeza", "conducir_volante", "silla_de_ruedas",
    "jugar_con_juguetes_en_el_suelo", "beber_agua_grifo", "no_entrar", "esperar_el_bus_parada", "subir_al_bus", "jugar_ajedrez_dos_personas", "jugar_ajedrez_tablero", "jugar_con_piezas_geometricas", "no_mirar_no_ver", "grupo_caminando",
    "levantar_la_mano_en_clase", "hablar_conversar", "ayudar_a_persona_en_silla_de_ruedas", "salir_de_una_habitacion", "sentarse_en_fila_cine_teatro", "jugar_baloncesto", "ojo_vision_lateral", "cruzar_los_brazos_prohibido", "jugar_voleibol_de_playa", "tocar_la_oreja_escuchar",
    "mirar_hacia_adelante", "abrir_la_puerta", "jugar_con_tablet", "mirar_television", "escuchar_perfil", "escuchar_musica_niña", "escuchar_musica_niño", "lanzar_pelota", "comer_niña", "levantar_manos",
    "mirar_niños", "prohibido_comer", "estar_de_pie", "escuchar_radio_niño", "leer_libro", "hacer_pesas", "estudiar_escribir", "pensar_compartir_ideas", "usar_celular", "saludar_espalda",
    "saludar_frente", "cruzar_torniquete", "jugar_tenis_niño", "jugar_tenis_niña", "jugar_bolos_niña", "jugar_golf_niña", "jugar_ajedrez", "jugar_damas", "tenis_silla_ruedas", "escuchar_musica_silla",
    "baloncesto_silla_ruedas", "escuchar_radio_monigote", "jugar_baloncesto", "amar_querer", "oler_flor", "hablar_cara_a_cara", "esperar_fila_niños", "lanzar_pelota_monigote", "jugar_futbol", "subir_autobus_niño",
    "subir_autobus_niña", "bajar_autobus", "autobus_rampa", "interior_autobus", "esperar_parada", "entrar_autobus", "ascensor", "rezar", "amamantar", "dar_biberon",
    "jugar_bebe", "dormir_litera", "futbol_americano", "mover_cabeza_lados", "elegir_opcion", "hacer_fila", "aseos_baños", "sala_espera", "escuchar_auriculares", "ventana_tren",
    "ayudar_silla_ruedas", "pulgar_abajo_triste", "pensar_duda", "comer_sopa", "mirarse_espejo", "jugar_rayuela_niña", "jugar_pelota_sentados", "jugar_rayuela_niño", "jugar_rayuela_monigote", "sentir_corazon_niña",
    "sentir_corazon_niño", "esperar_tren", "andén_estacion", "esperar_autobus", "jugar_minigolf", "jugar_golf_niño", "jugar_petanca", "triste_niña", "triste_niño", "dar_regalo",
    "pedir_por_favor", "mesa_trabajo", "escuela_colegio", "correcto_incorrecto", "estudiar_mesa", "sentarse_esperar", "dudar_no_saber", "escuchar_audio", "sentarse_suelo_triste", "jugar_bolos_monigote",
    "jugar_bolos_color", "jugar_arena", "jugar_canicas", "jugar_barro", "dar_vueltas"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")