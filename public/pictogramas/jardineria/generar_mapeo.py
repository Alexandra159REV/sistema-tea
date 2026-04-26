import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2256", "2331", "2361", "2434", "2666", "2867", "2981", "2996", "3051", "3052",
    "3057", "3070", "3079", "3080", "3102", "3113", "3114", "3122", "3126", "3127",
    "3138", "3144", "3148", "3151", "3159", "3160", "3163", "3174", "3194", "3195",
    "3198", "3201", "3203", "3205", "3211", "3214", "3216", "3219", "3318", "3319",
    "3386", "4846", "5062", "5063", "5076", "5077", "5460", "6040", "6503", "6504",
    "6897", "6911", "6921", "6967", "7104", "7105", "7153", "7224", "7245", "7281",
    "7803", "7804", "7819", "8056", "8157", "8328", "8512", "8585", "8601", "8614",
    "8668", "8689", "9142", "10220", "10250", "11202", "11214", "11265", "11272", "11274",
    "11309", "11310", "11321", "11322", "11334", "11395", "11397", "11572", "11590", "14242",
    "14244", "14246", "14248", "17103", "21413", "21894", "21902", "23701", "23913", "23991",
    "24537", "25650", "25853", "25894", "26067", "26310", "26381", "28567", "28571", "28725",
    "28843", "28849", "28853", "28857", "28861", "29772", "29855", "30014", "30241", "30522",
    "30608", "30609", "32462", "32685", "32687", "32738", "32741", "33010", "33988", "34043",
    "34053", "34175", "34223", "34229", "34543", "34753", "35367", "35399", "35753", "35755",
    "36287", "36340", "36359", "36394", "36921", "37009", "37013", "37114", "37131", "37145",
    "37147", "37148", "37149", "37150", "37151", "37152", "37153", "37168", "37169", "37171",
    "37584", "37585", "37598", "37602", "37676", "37691", "37722", "37869", "37986", "38002",
    "38070", "38254", "38268", "38269", "38526", "38527", "38624", "38767", "38795", "38806",
    "38970", "39007", "39101", "39192", "39291", "39389", "39390", "39391", "39404", "39468",
    "39541", "39651", "39671", "39811"
]

nombres = [
    "arbol", "setas", "cubo_y_pala", "parque", "bosque", "pala", "acelga", "puerro", "abeto", "acebo",
    "arbol_v2", "cactus", "hoja", "clavel", "flor", "hierba", "margarita_v2", "limonero", "planta", "margarita",
    "palmera", "platanero", "raiz", "rosa", "tallo", "tierra", "tulipan", "almendro", "cerezo", "ciruelo",
    "cocotero", "higuera", "manzano", "naranjo", "olivo", "peral", "pino", "sauce_lloron", "vivero", "fruteria",
    "seta", "baqueta", "arbol_invierno", "arbol_otoño", "hoja_marron", "hoja_verde", "espinacas", "caña_azucar", "amapola_v2", "amapola",
    "flor_v2", "trigo", "avena", "cebada", "margarita_v3", "clavel_v2", "flor_marchita", "rama", "sembrar", "trebol",
    "espiga", "ramo_flores", "tronco", "petunia", "geranio", "niscalo", "bonsai", "nenufar", "helecho", "hoja_v2",
    "piña_pino", "semilla", "mimosa", "champiñon", "perro_guia", "capullo", "cesped", "jardinera", "geranio_v2", "girasol",
    "maceta_v2", "macetas", "orquidea", "caña", "perejil", "pensamiento", "regadora", "cactus_v2", "madroño", "lavanda",
    "romero", "tomillo", "manzanilla", "planton", "bambu", "albahaca", "azafran", "papiro", "yuca", "cipres",
    "sauce", "seto", "arbusto", "calas", "lechuga_v2", "pensamiento_v2", "huerto", "narciso", "hojas_otoño", "enredadera",
    "cactus_v3", "castaño", "avellano", "nogal", "muerdago", "lirio", "plantas_v2", "planeta_tierra", "monte", "rosal",
    "jardin", "parque_v2", "arboleda", "tuna", "algodon", "gota_resina", "eucalipto", "raqueta_badminton", "invernadero", "tulipanes",
    "semilla_v2", "encina", "pino_v2", "rama_pino", "pala_y_rastrillo", "chopo", "palmeras", "arbol_v3", "trufa", "rucula",
    "maiz", "celula_vegetal", "chumbera", "flor_pascua", "semilla_germina", "raiz_v2", "ficus", "junco", "arbol_v4", "antera",
    "estambre", "estigma", "ovulo", "pistilo", "polen", "sepalo", "caliz", "corola", "petalo", "fotosintesis",
    "azalea", "iris", "acelgas", "mortero", "baobab", "espiga_trigo", "malva", "granado", "urbanizacion", "abeto_v2",
    "flores_silvestres", "azada", "bellota", "calendula", "ajenuz", "sesamo", "violetas", "floristería", "manzanilla_v2", "frutales",
    "bellota_v2", "espina", "rosas", "hierbas_aromaticas", "sesamo_v2", "cilantro", "buganvilla", "peral_v2", "albaricoquero", "moho",
    "aloe_vera", "champiñones", "arbol_v5", "corteza"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")