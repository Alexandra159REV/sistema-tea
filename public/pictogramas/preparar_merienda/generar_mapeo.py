import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2276", "2329", "2349", "2400", "2445", "2462", "2468", "2469", "2483", "2494",
    "2525", "2530", "2532", "2557", "2561", "2610", "2675", "2703", "2865", "2874",
    "2875", "2906", "2955", "2979", "2983", "3022", "3247", "3327", "3328", "4653",
    "4695", "4768", "4769", "4940", "5537", "5931", "6061", "6456", "6508", "6509",
    "6971", "7219", "7240", "7247", "7292", "7763", "8009", "8303", "8305", "8316",
    "8317", "8360", "8540", "8594", "8616", "8673", "8674", "8684", "8730", "8975",
    "8976", "8977", "9054", "9059", "10149", "10150", "10218", "10224", "10228", "10230",
    "10232", "10235", "11227", "11269", "11298", "13034", "13074", "13084", "13352", "13644",
    "13645", "15453", "16303", "16813", "16829", "16857", "17292", "25185", "25237", "27489",
    "27776", "28339", "28413", "28414", "28415", "28521", "28641", "29012", "29177", "29179",
    "29191", "29220", "29716", "29808", "29993", "31880", "34008", "34045", "34088", "34120",
    "34151", "34611", "34775", "34777", "34826", "35037", "35145", "35159", "35607", "35657",
    "36153", "36344", "36402", "36469", "36488", "36515", "36540", "36586", "36655", "36944",
    "36965", "36988", "37058", "37272", "37505", "37508", "37509", "37528", "37592", "37599",
    "37642", "37841", "37842", "37881", "38011", "38012", "38230", "38242", "38397", "38413",
    "38494", "38505", "38525", "38611", "38671", "38707", "38723", "38726", "38732", "38733",
    "38743", "38965", "38982", "38983", "39083", "39093", "39105", "39536", "39584", "39590",
    "39614", "39629", "39630", "39631", "39691"
]

# Lista de Nombres
nombres = [
    "beber", "cerezas", "comer", "fresa", "leche", "manzana", "melocoton", "melon", "naranja", "pan",
    "piña", "platano", "plato", "sandia", "pera", "vaso", "verter", "uvas", "pan_de_molde", "aceitunas_verdes",
    "aceitunas_negras", "frambuesas", "kiwi", "higo", "albaricoque", "limon", "uvas_verdes", "fruteria", "frutero_vendedor", "frutero_recipiente",
    "imagen_galeria", "vaso_de_agua", "vaso_de_leche", "mermelada", "pelar_fruta", "brocheta_fruta", "beber_pajita", "fresa_v2", "manzana_roja", "beber_biberon",
    "bebe_comiendo", "ensalada", "carne_cruda", "servir_bebida", "cortar_pan", "ketchup", "aguacate", "cereza_v2", "ciruela", "mora_negra",
    "aceituna_v2", "mora_azul", "chirimoya", "granada", "lavar_manos", "prohibido_tocar", "prohibido_fumar", "limon_v2", "naranja_v2", "lavar_cabeza",
    "lavar_cuerpo", "lavar_manos_v2", "platano_v2", "untar_pan", "cortar_verdura", "cortar_carne", "platano_v3", "coco", "galletas", "vaso_leche_v2",
    "pan_v2", "limon_v3", "datiles", "puesto_fruta", "mandarina", "arandanos", "nispero", "frambuesas_v2", "pomelo", "manzana_verde",
    "manzana_amarilla", "lima", "champiñones", "albaricoque_v2", "papaya", "plato_v2", "platano_v4", "leche_formula", "cafe", "beber_agua_v2",
    "comer_v2", "frutas_variadas", "comer_bocadillo", "comer_galleta", "comer_pan", "mandarina_v2", "comer_fruta", "tortitas", "prohibido_bebida", "prohibido_comida",
    "carne_picada", "cuchillo", "pan_integral", "pan_v3", "tienda_comestibles", "comer_sopa", "leche_v3", "platano_v5", "plato_v3", "uvas_v2",
    "hamburguesa", "lavar_cara", "lavar_cara_v2", "lavar_cara_v3", "lavar_manos_v3", "lavar_pelo", "frutas_v3", "pelar_platano", "batido_leche", "bol_fruta",
    "melon_v2", "patatas_cocidas", "huevo", "pan_v4", "fruta_azul", "carne_v2", "fresa_v3", "pan_v5", "plato_v4", "pan_v6",
    "masa_pan", "cocinar", "caja_fruta_v2", "vaso_v2", "puerro", "nispero_v2", "caqui", "biberon", "batido_v2", "cerezas_v3",
    "filete", "pan_v7", "fruta_cortada", "baguette", "beber_agua_v3", "rosquilla", "persona_comiendo", "tensio_arterial", "mojar_pan", "persona_bebiendo",
    "uvas_v3", "vaso_v3", "pan_v8", "lavar_pies", "tienda_fruta", "pastel", "pan_v9", "limpiar_mesa", "pan_v10", "pan_v11",
    "fruta_congelada", "baguettes", "lavar_manos_v4", "lavar_manos_v5", "beber_agua_v4", "melocoton_v2", "maracuya", "palomitas", "pate", "pan_v12",
    "limon_v4", "kiwi_v2", "chirimoya_v2", "pelar_platano_v2", "calabacin"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")