import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2317", "2742", "2806", "3180", "5913", "6491", "6606", "6964", "9814", "9815",
    "10258", "10259", "10260", "11245", "13634", "15734", "15925", "22771", "22777", "23400",
    "24469", "24471", "24679", "24680", "24947", "25552", "26811", "27067", "27278", "27279",
    "27280", "28225", "28687", "28689", "28926", "29845", "29847", "31374", "32352", "32546",
    "32548", "32550", "32554", "32697", "32705", "32798", "32940", "33072", "34709", "34798",
    "35433", "35434", "36361", "36362", "36363", "36364", "36365", "36366", "36367", "36368",
    "36369", "36370", "36371", "36372", "36373", "36374", "36375", "36457", "36458", "36459",
    "36461", "36462", "36465", "36485", "36486", "36489", "36636", "37060", "37428", "37545",
    "37740", "39047", "39170", "39200", "39265", "39397", "39398", "39606"
]

# Lista de Nombres (88 elementos)
nombres = [
    "casa", "entrar", "salir", "caravana", "libreta", "abrir_puerta", "cerrar_puerta", "casita", "pupitre_1", "pupitre_2",
    "colegio_1", "colegio_2", "colegio_3", "estudiar", "clase", "reunion", "clase_musica", "baile_1", "baile_2", "coro",
    "idiomas", "religion", "pensar_idea", "recordar", "iglesia", "terapia_grupo", "esperar", "entrar_baño", "subir_piscina_1", "subir_piscina_2",
    "subir_piscina_3", "habitacion", "entrar_puerta", "salir_puerta", "casa_campo", "familia_casa", "vecinos", "llamar_puerta", "visita", "portatil_1",
    "portatil_2", "portatil_3", "matematicas", "historia", "ingles", "casa_interior", "mudanza", "aula", "clase_online", "musica_online",
    "pentagrama_1", "pentagrama_2", "medicina", "biologia", "geometria", "economia", "psicologia", "naturaleza", "geografia_francia", "geografia_mundo",
    "geografia_españa", "arte", "geografia_mundo_2", "lectura", "filosofia", "fisica", "quimica", "psicoterapia_1", "psicoterapia_2", "psicoterapia_3",
    "psicoterapia_4", "psicoterapia_5", "tienda_muebles", "estudiar_sentado_1", "estudiar_sentado_2", "estudiar_sentado_3", "baloncesto_colegio", "leer_biblioteca", "fisioterapia", "informatica",
    "aleman", "pizarra", "religion_cristiana", "casa_pueblo", "nido", "bañera_1", "bañera_2", "examen_aula"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")