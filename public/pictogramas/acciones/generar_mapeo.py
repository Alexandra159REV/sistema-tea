import pandas as pd

# 1. Pegamos aquí las listas que te pasé
# Lista de IDs (158 elementos)
ids = [
    "2369", "2439", "2719", "2782", "3251", "4563", "4738", "5981", "6044", "6465", 
    "6479", "6513", "6514", "6537", "6600", "6610", "6626", "7195", "7196", "7221", 
    "7296", "8544", "10154", "10160", "10162", "10163", "10369", "11225", "11226", "11536", 
    "11538", "15507", "16025", "16739", "16741", "16743", "16745", "16877", "16879", "16881", 
    "16905", "17038", "17040", "21583", "23392", "24009", "24010", "24527", "24551", "24552", 
    "25181", "25182", "25532", "28295", "28425", "28431", "28439", "28609", "28623", "28661", 
    "28833", "28921", "29123", "29124", "29125", "29153", "29190", "29240", "30480", "30857", 
    "30901", "31141", "31718", "31719", "31790", "31841", "31892", "31917", "32093", "32214", 
    "32218", "32236", "32693", "32694", "32908", "32944", "32945", "32946", "33912", "35241", 
    "35242", "35245", "35247", "35361", "35371", "35411", "37203", "37287", "37484", "37540", 
    "37608", "37768", "37855", "37950", "37952", "37963", "37971", "37972", "37973", "37975", 
    "37982", "37983", "38467", "38547", "38549", "38550", "38585", "38714", "39002", "39274", 
    "39403", "39408", "39438", "39439", "39656", "39663", "39673", "39675", "39682", "39683", 
    "39835", "39836", "39837", "39838", "39839", "39840", "39841", "39842", "39843", "39844", 
    "39845", "39846", "39847", "39848", "39849", "39850", "39851", "39852", "39853", "39854", 
    "39855", "39856", "39857", "39858", "39859", "39860", "39861", "39862"
]

# Lista de Nombres (158 elementos)
nombres = [
    "dormir", "jugar_pelota", "correr", "ver_television", "caminar", "aplaudir", "saco_de_dormir", "comer_yogur", "caminar_despacio", "correr_rapido",
    "soñar", "tenis_individual", "tenis_parejas", "jugar_voley", "pareja_amor", "saludo_manos", "mirar_television", "señal_parar", "señal_esperar", "pedir_turno",
    "mirar_fijamente", "carrera_atletismo", "cruzar_calle", "jugar_golf", "jugar_videojuegos", "jugar_bolos", "duda_pregunta", "zapatear", "sentarse", "beso_amor",
    "beso_pareja", "lavarse_manos_grifo", "dar_regalo", "ronda_niños", "jugar_equipo", "jugar_futbol", "lavabo_baño", "recibir_regalo", "entregar_paquete", "compartir_juguete",
    "ver_television_sofa", "entregar_objeto", "recibir_objeto", "echar_crema_solar", "bloques_construccion", "ayudar_persona", "ayudar_niño", "ayudar_silla_ruedas", "correr_niños", "caminar_juntos",
    "jugar_ajedrez", "jugar_damas", "cocinar_sarten", "jugar_bolos_accion", "descansar_butaca", "pasar_pelota", "correr_rapido_v2", "jugar_tenis_mesa", "dormir_niña", "mirar_television_niña",
    "dar_dinero", "correr_niños_v2", "ver_television_niño", "ver_tele_lateral", "ver_tele_sentado", "usar_raton", "fuegos_artificiales", "pelear_niños", "dar_moneda", "recoger_moneda",
    "cinta_correr", "lanzar_pelota", "cambiar_pañal", "dar_biberon", "silla_oficina", "empujar_silla_ruedas", "jugar_voley_v2", "mujer_embarazada", "silla_ruedas_ayuda", "caminar_niño",
    "bebe_durmiendo", "dormir_cama", "andador_juguete", "carrito_bebe", "caminar_mujer", "usar_andador", "andador_anciano", "usar_baston", "recepcion_hospital", "jugar_tenis",
    "jugar_bolos_v2", "jugar_golf_v2", "jugar_ajedrez_v2", "baloncesto_niños", "encestar_balon", "dormir_placidamente", "señalar_derecha", "jugar_balonmano", "regatear_futbol", "aplaudir_niño",
    "jugar_bloques", "jugar_bloques_niña", "cantar_sentado", "cantar_niño", "cantar_niña", "jugar_pelota_silla_rueda", "fronton_niño", "fronton_saque", "fronton_jugador", "fronton_golpe",
    "caminar_izquierda", "jugar_lacrosse", "correr_cortina", "saludar_mano", "dormir_reloj", "caminar_derecha", "caminar_cinta", "cuna_bebe", "madre_hijo_sofa", "ayudar_anciano",
    "comer_rapido", "jugar_rayuela", "lanzar_balon_sentado", "equilibrio_barra", "agacharse", "bajar_rampa", "caminar_barra_equilibrio", "equilibrio_un_pie", "voltereta", "rayuela_salto",
    "recoger_pelota_suelo", "perro_guia", "caminar_campo", "masaje_pie", "jugar_minigolf", "jugar_golf_campo", "jugar_bochas", "estar_sentado", "ponerse_guantes", "fila_niños",
    "curar_herida", "poner_pomada", "silla_ruedas_rapido", "caminar_persona", "jugar_bolos_niño", "jugar_bolos_niña", "dolor_pecho", "jugar_arena", "saltar_obstaculo", "jugar_barro",
    "abrazar", "saltar_cuerda", "leer_libro", "escribir_cuaderno", "pintar_pincel", "dibujar_lapiz", "escuchar_musica", "bailar_feliz"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('acciones.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")