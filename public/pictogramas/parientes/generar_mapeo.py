import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2243", "2244", "2317", "2340", "2350", "2361", "2364", "2386", "2392", "2408",
    "2422", "2423", "2458", "2482", "2497", "2498", "2859", "3065", "3116", "3139",
    "3150", "3161", "3180", "3255", "3273", "3389", "4560", "4572", "4602", "4608",
    "4652", "4754", "5430", "5590", "5926", "6063", "6073", "6144", "6165", "6455",
    "6469", "6470", "6471", "6523", "6618", "6876", "6952", "7257", "7770", "9885",
    "9887", "10194", "10340", "10341", "11356", "11728", "11729", "11731", "11733", "12303",
    "21353", "22771", "22777", "23394", "23400", "23709", "23710", "23717", "23718", "23837",
    "24234", "24515", "24517", "24519", "24521", "24679", "24680", "24793", "24797", "24947",
    "25000", "25297", "25552", "25682", "25684", "25686", "26495", "26865", "27162", "27163",
    "27164", "27166", "27169", "27170", "27171", "27172", "30213", "30245", "30260", "30261",
    "30262", "30263", "30264", "30265", "30266", "30267", "30268", "30269", "30270", "30271",
    "30272", "30273", "30274", "30275", "30276", "30277", "30278", "30279", "30280", "30281",
    "30282", "30283", "30284", "30285", "30286", "30287", "30288", "30289", "30291", "30292",
    "30293", "31146", "31148", "31466", "31467", "32714", "32732", "32767", "32798", "33962",
    "34510", "34511", "34814", "35201", "35557", "35561", "35569", "35583", "35589", "35597",
    "35721", "36207", "36209", "36406", "36407", "36920", "36927", "36977", "37014", "37015",
    "37346", "37352", "37353", "37354", "37682", "37957", "37966", "37967", "38023", "38025",
    "38082", "38083", "38085", "38152", "38154", "38155", "38156", "Matemáticas", "Biologia", "Geologia",
    "38157", "38158", "38159", "38160", "38169", "38170", "38172", "38186", "38187", "38256",
    "38351", "38366", "38554", "38600", "38601", "38809", "39008", "39097", "39203", "39207",
    "39265", "39392", "39470", "39475", "39544", "39565", "39566", "39568", "39571", "39610"
]

nombres = [
    "abuela", "abuelo", "casa", "coche", "cometa", "cubo", "libro", "espaldera", "niños", "globo",
    "padre_hijos", "madre_hijos", "madre_bebe", "niña", "padre_bebe", "basura", "parque_infantil", "tienda", "hospital", "papa_noel",
    "reno", "trineo", "caravana", "banco", "fuente", "supermercado", "hombre", "balancín", "cine", "columpios",
    "vaso_hielo", "kiosko", "tobogán", "soñar", "cuaderno", "libro_abierto", "carnet_biblioteca", "mujer_mochila", "hombre_mochila", "esquiar",
    "leer_cuento", "libro_lectura", "cuento_infantil", "farmacia", "carrito_compra", "abuelos", "calor", "dormir_soñar", "niñas_gemelas", "familia_v1",
    "familia_v2", "mujer_mayor", "niño_pequeño", "niña_pequeña", "picor", "padre_hijo", "madre_hija", "madre_hijo", "padre_hija", "tortuga",
    "firmar", "bañarse", "ducharse", "leer", "mirar", "abuela_v2", "mujer_v2", "abuelo_v2", "hombre_v2", "estudiar",
    "obispo", "familia_numerosa_v1", "familia_numerosa_v2", "familia_numerosa_v3", "familia_numerosa_v4", "pensar", "recordar", "enseñar", "clase_magistral", "iglesia",
    "parque", "papa_noel_v2", "reunion", "leer_v2", "leer_v3", "leer_v4", "tobogán_v2", "frio_simbolo", "hombre_v3", "hombre_niño",
    "hombre_v4", "hombres_juntos", "mujer_niña", "mujer_v3", "mujer_v4", "hombre_mujer", "panadería", "familia_v3", "familia_numerosa_v6", "familia_numerosa_v7",
    "familia_numerosa_v8", "familia_numerosa_v9", "familia_numerosa_v10", "familia_numerosa_v11", "familia_numerosa_v12", "familia_numerosa_v13", "familia_numerosa_v14", "familia_numerosa_v15", "familia_numerosa_v16", "familia_numerosa_v17",
    "familia_numerosa_v18", "familia_numerosa_v19", "familia_numerosa_v20", "familia_numerosa_v21", "familia_numerosa_v22", "familia_numerosa_v23", "familia_numerosa_v24", "familia_numerosa_v25", "familia_numerosa_v26", "familia_numerosa_v27",
    "familia_numerosa_v28", "familia_numerosa_v29", "familia_numerosa_v30", "familia_numerosa_v31", "familia_numerosa_v32", "familia_numerosa_v33", "familia_numerosa_v34", "familia_numerosa_v35", "familia_numerosa_v36", "familia_numerosa_v37",
    "familia_numerosa_v38", "familia_numerosa_v39", "padre_bebe_v2", "madre_niño_v2", "familia_v4", "familia_v5", "familia_hospital", "autobús", "salón", "casita",
    "libros_estantería", "familia_v6", "familia_v7", "dar_dinero", "familia_v8", "tiritar", "calor_v2", "mareo", "frio_v2", "nieve_frio",
    "calor_simbolo", "calor_v3", "ambulancia", "centro_salud", "templete", "calor_lampara", "familia_v9", "familia_v10", "familia_v11", "columpios_v2",
    "ordenador", "padre_hijo_v2", "madre_hija_v2", "madre_niño_v3", "padre_hija_v2", "dormir_monitorizado", "bolsa_frio", "madre_hijos_v2", "padre_hijos_v2", "columpios_v3",
    "columpio_v4", "hospital_v2", "clínica", "parque_v2", "ordenador_v2", "ley", "justicia", "matematicas", "fisica", "astronomia",
    "biologia", "botanica", "arco", "arquitectura", "fotografía", "clase", "aula", "papelera_calle", "grupo_personas", "prohibido_personas",
    "tiovivo", "familia_v12", "familia_v13", "familia_circulo", "pareja_novios", "arbol_genealogico", "pueblo", "cine_v2", "casita_pajaro", "dentista",
    "rodaje", "mostrador_comida", "torno_entrada", "sube_y_baja", "columpio_adaptado", "camilla", "muelle_parque", "familia_v14"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")