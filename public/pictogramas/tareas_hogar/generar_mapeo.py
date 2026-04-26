import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (Tareas del hogar)
ids = [
    "2650", "2724", "2816", "2818", "2916", "2917", "3129", "3143", "3351", "4570",
    "4878", "4942", "4943", "4944", "5514", "5549", "5558", "5569", "6059", "6065",
    "6562", "7052", "8499", "8523", "8596", "8679", "8680", "8726", "8727", "9008",
    "9009", "9025", "9035", "9072", "10141", "10315", "11302", "11348", "11363", "11385",
    "11386", "11751", "11963", "15469", "15471", "15479", "16803", "16869", "16871", "17269",
    "17271", "17298", "17300", "17302", "21914", "21952", "21984", "22082", "24312", "24354",
    "24355", "24595", "29736", "29742", "29746", "29748", "29750", "29834", "29835", "30150",
    "32568", "33998", "34173", "34782", "34801", "36447", "36542", "36543", "36661", "36856",
    "36858", "36861", "36933", "37417", "37534", "38000", "38021", "38030", "38071", "38126",
    "38129", "38206", "38226", "38227", "38289", "38363", "38415", "38459", "38613", "39032",
    "39033", "39034", "39035", "39046", "39099", "39202", "39450", "39458", "39562", "39636",
    "39700", "39703", "39767", "39768", "39799"
]

# Lista de Nombres (Tareas del hogar)
nombres = [
    "barrer", "papelera", "regar_planta", "recoger_hojas", "limpiar_mesa", "mesa_circular", "plantar", "limpiar_cristal", "dar_la_mano", "limpiar_polvo",
    "sacudir_alfombra", "mesa_centro", "mesa_comedor_vacia", "mesa_redonda", "poner_cubitos", "poner_mesa", "quitar_mesa", "cascanueces", "fregar_suelo", "fregar_platos",
    "sacar_basura", "mesa_madera", "estanteria", "caja_mudanza", "camion_basura", "horno", "basura_organica", "jugar_coche", "limpiar_zapatos", "cepillar_zapatos",
    "limpiar_ventana", "limpiar_vidrio", "buzon_correo", "limpiar_mueble", "tender_ropa", "hacer_puzzle", "colgar_estanteria", "escoba_recogedor", "mesa_estudio", "apartamento",
    "caja_juguetes", "tienda_juguetes", "rompecabezas", "empujar_bola", "cepillo_dientes", "dar_objeto", "comer_juntos", "bolsa_reciclaje", "limpiar_espejo", "reparar",
    "lavar_platos", "cortar_alimentos", "secar_platos", "lavavajillas_vacio", "ordenar_cubiertos", "escurridor", "doblar_ropa", "coser_boton", "planchar_manga", "regar_jardin",
    "pulverizar", "aspersor", "espantapajaros", "poner_jabon", "secar_manos", "limpiar_con_trapo", "limpiar_ventana_v2", "limpiar_espejo_v2", "limpiar_bidet", "limpiar_oidos",
    "limpiar_nariz", "curar_herida", "recoger_juguetes", "usar_celular", "limpiar_huerto", "ordenar_escritorio", "limpiar_pizarra", "sacapuntas_lapiz", "cepillar_dientes_v2", "hilo_dental",
    "productos_limpieza", "poner_guantes", "quitar_guantes", "lavar_manos_v2", "limpiar_alfombra", "cubo_basura", "limpiar_mesa_v2", "desodorante", "servir_comida", "plancha",
    "tabla_planchar", "limpiar_suelo_v2", "limpiar_polvo_v2", "sacar_bolsa_basura", "recoger_basura_suelo", "recoger_excrementos", "regar_huerto", "escavar", "sembrar", "limpiar_mesa_v3",
    "mesa_merendero", "sacar_basura_v2", "regar_planta_v2", "contenedor_vidrio", "contenedor_papel", "contenedor_plastico", "contenedor_pilas", "bañar_mascota", "regar_arbol", "cortar_papel",
    "poner_mesa_v2", "cortar_con_tijeras", "huerto_urbano", "abono_fertilizante", "limpiar_piscina", "fregar_plato_v2", "poner_cubiertos_v2", "lavar_platos_v2", "barrer_v2"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")