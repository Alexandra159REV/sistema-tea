import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2294", "2337", "2351", "2372", "2403", "2404", "2405", "2449", "2490", "2498",
    "2509", "2517", "2520", "2533", "2552", "2609", "2638", "2650", "2671", "2843",
    "2878", "2934", "2945", "2998", "3004", "3015", "3243", "3316", "3334", "3335",
    "3346", "3368", "4619", "4657", "4766", "4786", "5380", "6174", "6245", "6643",
    "6882", "6923", "6967", "7057", "7058", "7059", "7060", "7114", "7199", "7201",
    "7202", "8530", "8711", "9016", "9062", "9063", "9072", "9200", "9679", "9801",
    "10145", "10240", "11176", "13022", "13340", "16900", "17245", "21380", "24905", "25026",
    "25125", "25187", "25293", "25624", "25654", "25970", "25996", "26270", "26271", "26302",
    "26547", "27501", "27625", "27627", "27640", "27699", "27780", "27853", "27968", "28477",
    "28479", "28819", "29690", "29702", "29708", "29913", "33014", "33015", "34041", "34075",
    "34082", "34143", "34205", "34294", "34308", "34417", "34419", "34427", "34431", "34577",
    "34583", "34597", "34850", "35053", "35359", "35451", "35483", "35485", "35997", "36177",
    "36424", "36986", "37132", "37133", "37226", "37317", "37588", "37606", "37693", "37702",
    "37703", "37704", "37783", "38141", "38318", "38320", "38324", "38327", "38330", "38333",
    "38341", "38431", "38506", "38947", "38967", "38968", "39162", "39845"
]

# Lista de Nombres (158 elementos)
nombres = [
    "caballo", "cisne", "conejo", "elefante", "gallina", "gallo", "gato", "leon", "pajaro", "paloma",
    "pavo", "perro", "pez", "pollito", "canario", "vaca", "aguila", "avestruz", "buho", "pez_espada",
    "ganso", "guacamayo", "lechuza", "buitre", "jilguero", "cigueña", "pinguino", "flamenco", "gaviota", "golondrina",
    "cobaya", "delfin", "cuervo", "gorrion", "urraca", "peces_acuario", "pelicano", "albatros", "colibri", "montar_caballo",
    "peces_pecera", "gallina_pollitos", "perro_collar", "comida_perro", "comida_gato", "alpiste", "comida_peces", "gata", "sardinas", "perrito_caliente",
    "perro_marron", "mapa_animales", "pasear_perro", "niña_pasear_perro", "martín_pescador", "cormoran", "pony", "gato_negro", "foca", "silueta_gato",
    "cepillar_perro", "pinguino_emperador", "perro_sentado", "abubilla", "pavo_real", "tienda_animales", "garza", "mono", "buho_real", "dar_biberon_animal",
    "gallo_v2", "leona", "paloma_v2", "pollo_asado", "gallinero", "codorniz", "perro_con_correa", "halcon", "aguila_v2", "pasear_perro_v2",
    "higado", "foca_v2", "montar_caballo_niño", "montar_caballo_niña", "cacatua", "periquito", "pato", "perdiz", "pez_payaso", "pato_v2",
    "anade", "paloma_torcaz", "pavo_v2", "avestruz_v2", "pasear_perro_v3", "huella_perro", "montar_caballo_v2", "jinete", "perro_cachorro", "gallina_v2",
    "gato_v2", "perro_v2", "caballo_ajedrez", "acuario_v2", "pajareria", "pez_cirujano", "pez_rojo", "pez_met", "pez_v2", "pez_disco",
    "caballito_mar", "pez_v3", "buho_v2", "gaviota_v2", "peluquero_canino", "perrera", "amazona", "jinete_v2", "perro_v3", "agility_perro",
    "perro_silla_ruedas", "condor", "veterinaria", "veterinario", "agility_v2", "esquilar_perro", "pez_v4", "pez_v5", "silueta_animal", "animal_herido",
    "establo", "perro_guia", "jaula_perro", "peluqueria_canina", "pez_v6", "pez_v7", "pez_v8", "pez_v9", "pez_v10", "pajaro_v2",
    "pez_v11", "perro_muerto", "collar_perro", "halcon_v2", "perro_v4", "gato_v3", "conejo_pascua", "perro_guia_v2"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")