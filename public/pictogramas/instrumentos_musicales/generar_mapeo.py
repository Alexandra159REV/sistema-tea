import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2315", "2318", "2396", "2417", "2463", "2495", "2521", "2531", "2559", "2564",
    "2578", "2604", "2607", "2615", "2616", "2717", "2746", "2778", "2870", "2890",
    "3094", "3256", "3266", "4585", "4771", "4922", "4924", "5476", "5695", "5900",
    "5909", "5923", "5938", "5949", "5964", "5974", "6233", "6234", "6235", "6249",
    "6567", "7270", "8234", "8315", "8340", "8341", "8345", "8364", "8493", "8599",
    "8606", "8709", "9123", "9124", "9125", "9126", "9127", "9128", "9129", "9130",
    "9193", "9201", "9700", "11201", "11240", "11311", "11400", "17196", "17214", "17223",
    "17332", "23777", "23811", "23819", "23867", "23897", "23937", "24049", "24091", "24093",
    "24396", "24424", "24777", "24791", "24795", "25115", "25658", "26262", "26286", "26933",
    "28553", "29171", "29718", "29719", "32015", "32131", "32701", "33044", "34027", "34029",
    "34527", "35023", "35031", "35057", "35371", "35411", "35461", "35463", "35465", "35467",
    "35625", "35626", "35641", "35667", "35711", "35719", "35051", "36115", "36463", "36639",
    "36669", "36670", "37327", "37707", "37807", "38000", "38041", "38091", "38096", "38103",
    "38104", "38105", "38228", "38296", "38450", "38453", "38455", "38464", "38466", "38704",
    "38779", "38784", "38785", "38786", "38948", "38984", "39020", "39044", "39045", "39740",
    "39771", "39850"
]

nombres = [
    "cantar", "castañuelas", "flauta_dulce", "guitarra_española", "maracas", "tambor", "piano", "platillos", "saxofon", "pandereta",
    "caja", "triangulo", "trompeta", "violin", "xilofono", "coro", "oyente", "musica", "orquesta", "director_coro",
    "director_orquesta", "bandurria", "pandereta_v2", "tocar_piano", "violonchelo", "bongos", "baquetas", "gaita", "acordeon", "armonica",
    "bateria", "campana", "metronomo", "oboe", "trompa", "tuba", "trombon", "bombardino", "fagot", "tocar_violin",
    "teclado", "partitura", "teclado_v2", "maraca", "guiro", "conga", "claves", "platillo_v2", "arpa", "guitarra_electrica",
    "bateria_v2", "bajo_electrico", "pentagrama_1", "pentagrama_2", "pentagrama_3", "clave_sol", "clave_fa", "clave_do_3", "clave_do_4", "mezclador_dj",
    "escribir_musica", "atril", "bailarina", "bailarina_v2", "director_banda", "contrabajo", "timbal", "cajon_flamenco", "pandereta_v3", "campanillas",
    "claves_v2", "baile_flamenco", "tocar_guitarra", "tocar_guitarra_v2", "tocar_saxofon", "tocar_organo", "percusion", "bateria_v3", "notas_musicales", "notas_musicales_v2",
    "flauta_travesera", "baquetas_v2", "organo", "cornetin", "partituras", "metronomo_v2", "atril_v3", "tocar_instrumento", "escuchar_musica", "escuchar_musica_v2",
    "cantar_v2", "escuchar_musica_v3", "grupo_musical", "flauta_v2", "marimba", "tambor_v2", "tocar_instrumento_v2", "compositor_1", "compositor_2", "baloncesto_musical",
    "baloncesto_musical_v2", "voley_musical", "guiro_v2", "clarinete_v2", "oboe_v3", "flauta_v3", "musical_1", "musical_2", "tocar_piano_v2", "instrumentos_viento",
    "tocar_musica", "escuchar_musica_v4", "percusion_v2", "guitarra_v2", "director_v2", "gong", "timbal_v2", "tambores_v2", "tocar_flauta", "percusion_v3",
    "guitarra_v3", "partituras_v2", "guitarra_v4", "piano_v3", "metalofono", "djembe_1", "djembe_2", "djembe_3", "oboe_v4", "musicos",
    "castañuelas_v2", "pandereta_v4", "metalofono_v2", "concierto", "flauta_v4", "bajo_electrico_v2", "palo_lluvia", "laud", "panflauta", "ocarina",
    "tocar_instrumentos_v3", "atril_v4", "atril_v5", "cd_musica", "xilofono_v2", "acordeon_v2", "melodica", "cuenco_tibetano"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")