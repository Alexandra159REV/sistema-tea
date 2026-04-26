import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (233 elementos)
ids = [
    "2317", "2364", "2498", "2859", "3065", "3116", "3180", "3255", "3273", "3389",
    "4572", "4602", "4608", "4754", "5430", "5926", "6063", "6073", "6455", "6469",
    "6470", "6471", "6472", "6483", "6523", "6618", "6639", "6640", "6642", "6643",
    "6964", "6973", "8346", "8542", "9183", "11255", "11270", "15925", "16151", "21405",
    "22771", "22777", "23394", "23400", "23837", "24679", "24680", "24793", "24797", "24947",
    "25000", "25552", "25682", "25684", "25686", "26495", "27499", "28225", "28369", "28370",
    "28371", "28372", "28373", "28374", "28375", "28376", "28377", "28378", "28379", "28380",
    "28381", "28382", "28383", "28384", "28926", "29026", "29845", "29847", "29849", "29857",
    "29859", "29875", "29903", "29921", "30213", "30387", "30616", "32246", "32352", "32450",
    "32484", "32712", "32714", "32732", "32732_v2", "32767", "32798", "32940", "33962", "33963",
    "33964", "33965", "34189", "34318", "34320", "34333", "34337", "34529", "34531", "34814",
    "34995", "34997", "35121", "35199", "35203", "36049", "36077", "36101", "36145", "36205",
    "36207", "36209", "36210", "36406", "36427", "36457", "36458", "36459", "36461", "36462",
    "36477", "36505", "36528", "36708", "36709", "36710", "36714", "36880", "36893", "37014",
    "37015", "37019", "37020", "37034", "37242", "37244", "37247", "37248", "37256", "37257",
    "37259", "37262", "37266", "37322", "37408", "37460", "37720", "38021", "38022", "38023",
    "38025", "38082", "38083", "38085", "38152", "38153", "38154", "38155", "38156", "38157",
    "38158", "38159", "38160", "38161", "38162", "38163", "38164", "38165", "38166", "38167",
    "38168", "38169", "38170", "38171", "38172", "38173", "38174", "38175", "38176", "38177",
    "38178", "38179", "38180", "38181", "38182", "38183", "38184", "38185", "38186", "38187",
    "38188", "38189", "38190", "38191", "38192", "38193", "38194", "38195", "38196", "38197",
    "38198", "38256", "38554", "38608", "38614", "38615", "38616", "38619", "38633", "38810",
    "38812", "39203", "39207", "39265", "39392", "39470", "39475", "39544", "39565", "39566",
    "39568", "39571", "39769", "39825"
]

# Lista de Nombres (233 elementos)
nombres = [
    "casa", "leer_cartilla", "papelera", "columpio", "tienda", "hospital", "caravana", "banco", "fuente", "supermercado",
    "balancin", "cine", "columpios_v2", "taquilla", "tobogan", "libro", "libro_v2", "biblioteca", "esquiar", "leer_cuento",
    "cuento", "cuento_v2", "pictogramas", "leer_pictogramas", "hospital_v2", "supermercado_v2", "tienda_animales", "tienda_ropa", "tienda_juguetes", "biblioteca_v2",
    "casa_v2", "leer_libro", "cuento_v3", "claqueta", "pelicula", "entrada_cine", "titeres", "biblioteca_v3", "centro_rehabilitacion", "museo",
    "bañarse", "ducharse", "leer", "estudiar", "biblioteca_v4", "pensar", "recordar", "teatro", "cine_v2", "iglesia",
    "parque_infantil", "reunion", "leer_v2", "leer_v3", "leer_v4", "tobogan_v2", "hotel", "albergue", "libro_texto_A", "libro_texto_B",
    "libro_texto_6", "libro_texto_5", "libro_texto_3", "libro_texto_C", "libro_texto_7", "libro_texto_0", "libro_texto_2", "libro_texto_1", "libro_texto_9", "libro_texto_N",
    "libro_texto_P", "libro_texto_2_v2", "libro_texto_T", "libro_texto_V", "granja", "laberinto", "centro_comunitario", "casa_familia", "aseos_mixtos", "museo_v2",
    "oficina", "spa", "centro_salud", "escalada", "farmacia", "cine_v3", "parque", "centro_dia", "residencia", "biblioteca_v5",
    "cine_v4", "fisioterapia", "hospital_v3", "autobus", "cuaderno", "salon", "casa_v3", "casa_v4", "casa_v5", "casa_v6",
    "libro_azul", "libro_verde", "biblioteca_v6", "cine_v5", "cine_v6", "cine_4D", "dormitorio", "recepcion", "mostrador", "pagar",
    "cine_3D_v1", "cine_3D_v2", "hospital_v4", "tobogan_v3", "tobogan_v4", "biblioteca_v7", "parque_v2", "columpio_v3", "parque_bolas", "centro_islamico",
    "centro_salud_v2", "hospital_v5", "sinagoga", "quiosco", "videojuego", "cine_v7", "cine_v8", "cine_v9", "cine_v10", "cine_v11",
    "conferencia", "butaca_cine", "ambulancia", "centro_salud_v3", "centro_salud_v4", "centro_salud_v5", "tobogan_v5", "parque_v3", "balancin_muelle", "tirolina",
    "ordenador", "tobogan_v6", "tobogan_v7", "ducha", "litera", "litera_v2", "tunel_psicomotricidad", "rocodromo", "litera_v3", "tunel_v2",
    "tunel_v3", "espaldera", "red_escalar", "consulta_medica", "hospital_v6", "cuaderno_v2", "columpio_v4", "cama_elastica", "puente_colgante", "parque_v4",
    "columpio_adaptado", "hospital_v7", "hospital_v8", "tobogan_v8", "ordenador_v2", "ley_004", "ley_034", "diccionario_038", "teatro_v3", "matematicas_50",
    "matematicas_51", "astronomia_52", "biologia_53", "ciencias_54", "biologia_55", "geologia_56", "geografia_57", "historia_58", "historia_59", "historia_62",
    "historia_63", "historia_71", "arquitectura_72", "arquitectura_74", "arte_75", "fotografia_77", "musica_78", "musica_79", "musica_82", "musica_81",
    "lectura_85", "lectura_87", "geografia_91", "fisica_93", "psicologia_159.9", "dibujo_379", "sociologia_316", "nutricion_641.5", "veterinaria_831", "empresa_658",
    "literatura_833", "literatura_832", "literatura_infantil_834", "comics_842", "comics_843", "comics_844", "comics_847", "comics_845", "comics_846", "historia_902",
    "historia_903", "papelera_v2", "tiovivo", "laboratorio", "columna_vertebral", "anatomia", "anatomia_v2", "fisioterapia_v2", "video", "charla",
    "charla_v2", "pueblo", "cine_v12", "nido", "dentista", "rodaje", "cine_v13", "lector_tarjetas", "parque_v5", "columpio_v5",
    "camilla_hospital", "muelle_v2", "libro_v3", "teatro_v4"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")