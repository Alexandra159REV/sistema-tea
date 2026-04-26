import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2714", "3241", "3299", "4550", "4633", "4955", "5912", "5936", "5973", "6071",
    "6157", "6461", "6960", "7796", "8065", "8106", "8175", "8660", "8990", "9098",
    "11225", "11226", "11584", "11586", "11588", "12326", "14532", "15349", "16643", "16992",
    "22194", "25453", "26242", "27218", "27264", "27265", "27917", "27921", "28549", "28657",
    "29720", "29907", "29917", "31064", "31065", "31068", "31892", "31937", "32825", "34090",
    "34181", "34377", "34409", "34443", "34455", "34508", "35741", "35773", "35774", "35775",
    "37074", "37076", "37077", "37079", "37112", "37225", "37313", "37327", "37486", "37656",
    "37882", "37888", "37890", "37891", "37925", "38214", "38578", "38631", "38761", "39078",
    "39152", "39224", "39235", "39268", "39399", "39665", "39682", "39683", "39785", "39841",
    "39856"
]

# Lista de Nombres (91 elementos)
nombres = [
    "contar_hasta_tres", "pelota_playa", "sentarse_sofa", "abrazo", "concierto", "profesora", "audifono", "susurrar", "pensar", "silencio",
    "musica", "hablar", "dormir", "maestro", "cartel_concierto", "espectaculo_musica", "cantante", "pelota_beisbol", "director_orquesta", "yoga",
    "zapatear", "sentarse_silla", "escenario_musical", "cantante_femenina", "banda_musica", "templete_musica", "musico", "escuchar_musica", "sentarse_comodo", "tienda_musica",
    "pelota_ejercicio", "soplar", "organo", "ping_pong", "nadar", "silbar", "teatro_marionetas", "marionetas", "descansar_sofa", "gritar",
    "escuchar", "pizarra_musica", "aula_musica", "sentarse_bien", "sentarse_mal", "persona_recta", "jugar_pelota", "descansar", "meditar", "bate_beisbol",
    "diapason", "respirar", "expirar", "dirigir_coro", "coro_niños", "olfatear", "radio_cassette", "boxeo_recreativo", "boxeo_entrenamiento", "boxeo_combate",
    "pelota_vasca_1", "pelota_vasca_2", "pelota_vasca_3", "pelota_vasca_4", "pelota_tenis", "clase_solfeo", "examen_musica", "tocar_flauta", "auriculares", "tocar_guitarra",
    "metronomo", "ejercitador_mano", "rulo_espuma", "pelota_fitball", "lanzar_pelota", "prohibido_ruido", "hacer_gestos", "juego_mesa", "postura_loto", "campanas_viento",
    "carrillon", "jugar_baloncesto", "altavoz", "coro_adultos", "jugar_voley", "actuacion_teatral", "fronton_1", "fronton_2", "pelota_golf", "hablar_bajo",
    "dolor_cabeza"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")