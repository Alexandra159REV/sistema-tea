import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (188 elementos)
ids = [
    "2283", "2304", "2307", "2340", "2350", "2361", "2386", "2408", "2482", "2506",
    "2507", "2508", "2540", "2605", "2637", "2650", "2658", "2676", "2724", "2818",
    "2872", "3063", "3090", "3130", "3241", "3265", "3282", "3427", "4759", "4877",
    "4923", "4924", "4930", "4935", "4945", "5094", "5099", "5441", "5481", "5514",
    "5570", "5935", "6059", "6065", "6156", "6208", "6457", "6608", "6954", "7054",
    "7254", "8146", "8309", "8313", "8318", "8499", "8508", "8517", "8583", "8596",
    "8663", "8679", "8680", "8728", "8734", "9025", "9072", "9134", "9204", "9813",
    "10281", "10315", "10368", "11236", "11295", "11363", "11385", "11386", "11687", "14544",
    "15479", "16443", "16711", "17204", "17298", "17300", "17302", "19528", "21914", "22212",
    "23699", "23810", "23875", "23887", "23891", "24595", "25282", "25690", "25900", "25986",
    "26238", "26403", "26660", "26661", "26724", "26897", "27208", "27296", "28441", "28577",
    "28721", "29740", "29742", "30600", "31093", "32248", "32568", "32663", "32693", "32694",
    "32730", "32798", "32832", "32864", "32892", "33990", "34363", "34518", "34525", "34543",
    "34989", "35231", "35341", "35611", "35617", "35619", "35620", "35621", "35653", "35697",
    "35727", "36013", "36389", "36507", "36518", "36543", "36661", "36676", "36678", "36693",
    "36884", "36885", "37042", "37058", "37092", "37156", "37255", "37417", "37448", "37537",
    "37721", "37825", "37826", "37943", "37948", "37960", "38013", "38022", "38034", "38106",
    "38126", "38129", "38206", "38226", "38227", "38459", "38645", "38735", "39030", "39031",
    "39032", "39033", "39034", "39035", "39036", "39037", "39038", "39039"
]

# Lista de Nombres (188 elementos)
nombres = [
    "bolos", "cama", "camion", "coche", "cometa", "cubo", "espaldera", "globo", "niña", "patines",
    "monopatin", "patinete", "puzzle", "triciclo", "consola", "mecano", "caja_herramientas", "papelera", "escoba", "bloques",
    "muñeca", "dardos", "pintar", "balon", "comba", "marioneta", "cuerda", "tobogan", "barrer", "caballo_balancin",
    "xilofono", "bloques_v2", "bloques_v3", "oso_peluche", "tren_madera", "hacer_cama", "jugar_pelota", "ordenar_cama", "echar_jabon", "balon_v2",
    "saltar", "caja", "limpiar_polvo", "bolsa_basura", "prohibido_jugar", "robot", "mando_distancia", "hula_hoop", "cama_v2", "caja_v2",
    "sonajero", "peonza_v1", "globo_v2", "patines_v2", "patinete_v2", "coche_v2", "piezas_lego", "payaso_caja", "pieza_puzzle", "cajon",
    "peonza_v2", "barrendero", "coche_v3", "jugar", "yo-yo", "carta", "sobre", "cubo_rubik", "patines_linea", "peluches",
    "canicas", "escoba_v2", "preguntar", "diana", "cartas_animales", "bolsa_juguetes", "tienda_juguetes", "puzzle_v2", "camion_v2", "cubos_apilar",
    "contenedor_reciclaje", "limpiar_suelo", "hacer_cama_v2", "muñecos", "proyector", "vasos", "bandeja_juegos", "tienda_v2", "recortar", "abaco_v1",
    "abaco_v2", "cama_hospital", "juego_quimica", "trampolin", "trampolin_v2", "videojuego_v2", "dominó", "cama_v3", "cama_v4", "cocinita",
    "muñeca_v2", "bloques_logicos", "tumbona", "tumbona_v2", "cesta_mascota", "marioneta_v2", "bolsa_basura_v2", "tumbona_v3", "saltar_comba", "pato_goma",
    "cuento", "fregar", "fregar_v2", "patines_linea_v2", "diabolo", "tumbona_v4", "tren_juguete", "frutas_juguete", "carrito_muñecas", "carrito_muñecas_v2",
    "correpasillos", "casita_muñecas", "tumbona_v5", "muelle_espiral", "molinillo", "cocinita_v2", "cubo_playa", "encajable", "jugar_muñeca", "cubo_v2",
    "dinosaurio", "juego_anillas", "tumbona_v6", "trampolin_v3", "trampolin_v4", "trampolin_v5", "trampolin_v6", "ajedrez", "muñeco_nieve", "jugar_parque",
    "hacer_cama_v3", "loto", "torre_apilable", "pelota_antiestres", "malabarista", "pintar_v2", "cesta_compra", "bloques_v4", "tambor", "clasificar",
    "futbolin", "bolsa_juguetes_v2", "escondite", "sentarse", "baul", "anillas_apilables", "barquito_juguete", "piscina_bolas", "papelera_v3", "bloques_v5",
    "pala_juguete", "marioneta_dedo", "no_gritar", "si_gritar", "pañuelos", "caja_carton", "pop-it", "chanclas", "trampolin_v7", "xilofono_vertical",
    "trompeta", "pata_coja", "orinar", "bolsa_juguetes_v3", "cajonera", "papelera_pedal", "papelera_v4", "jugar_tablet", "robot_limpieza", "marioneta_mano",
    "jugar_consola", "pista_coches", "papelera_v5", "camion_v3", "peluche_perro", "peluche_conejo", "osito", "muñeco_v3"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")