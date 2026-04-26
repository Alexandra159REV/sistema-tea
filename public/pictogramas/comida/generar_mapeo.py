import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (Comida)
ids = [
    "2246", "2248", "2265", "2274", "2320", "2323", "2329", "2341", "2342", "2345",
    "2349", "2362", "2363", "2382", "2384", "2399", "2400", "2438", "2445", "2446",
    "2462", "2468", "2469", "2473", "2483", "2494", "2503", "2525", "2530", "2532",
    "2554", "2557", "2561", "2593", "2594", "2610", "2619", "2656", "2660", "2668",
    "2675", "2679", "2703", "2708", "2838", "2839", "2847", "2848", "2865", "2874",
    "2875", "2906", "2955", "2958", "2981", "2983", "2995", "3222", "3230", "3235",
    "3237", "3247", "3257", "3270", "3289", "3325", "3327", "3328", "3373", "3378",
    "4625", "4653", "4661", "4694", "4768", "4769", "4875", "4876", "4931", "4933",
    "4940", "5370", "5392", "5452", "5460", "5485", "5487", "5509", "5515", "5579",
    "5605", "5811", "5924", "5925", "5981", "6057", "6244", "6456", "6508", "6509",
    "6877", "6889", "6984", "6985", "7012", "7017", "7020", "7130", "7144", "7150",
    "7160", "7162", "7219", "7240", "7264", "7292", "7300", "7783", "7805", "8009",
    "8015", "8016", "8026", "8211", "8303", "8305", "8334", "8360", "8481", "8492",
    "8504", "8540", "8546", "8568", "8592", "8594", "8678", "8684", "8730", "8984",
    "9023", "9036", "9038", "9039", "9084", "9085", "9175", "10135", "10149", "10150",
    "10224", "10230", "11184", "11227", "13074", "13084", "13364", "13644", "13645", "15453",
    "15457", "15459", "15712", "16285", "16303", "16745", "16813", "16829", "16857", "16883",
    "17175", "17273", "17292", "20126", "23847", "23913", "24099", "24119", "25119", "25137",
    "25185", "25532", "25560", "25578", "26067", "26553", "26716", "26806", "26929", "27053",
    "27756", "28157", "28339", "28343", "28521", "29191", "29212", "30526", "32310", "32470",
    "34059", "34086", "34120", "34151", "34359", "34693", "35045", "35605", "35703", "35873",
    "35875", "36354", "36469", "36483", "36839", "37180", "37509", "37842", "37881", "38011",
    "38282", "38505", "38523", "38604", "38671", "38807", "39004", "39105", "39243", "39254",
    "39388", "39536", "39542", "39549", "39565", "39630", "39691", "39767"
]

# Lista de Nombres (Comida)
nombres = [
    "aceite", "agua", "arroz", "batidora", "cazo", "cebolla", "cerezas", "cocina", "cocinar", "colador",
    "comer", "cuchara", "cuchara_postre", "cuenco", "esparragos", "fregar", "fresa", "judias_verdes", "leche", "lechuga",
    "manzana", "melocoton", "melon", "microondas", "naranja", "pan", "patata", "piña", "platano", "plato",
    "sal", "sandia", "tenedor", "tostador", "tomate", "vaso", "zanahoria", "bandeja", "berenjena", "beber",
    "guisantes", "calabaza", "uvas", "col", "pimiento_verde", "pimiento_rojo", "pepino", "calabacin", "pan_molde", "aceitunas",
    "aceitunas_negras", "frambuesas", "kiwi", "higos", "acelgas", "albaricoque", "alcachofa", "limon", "cacerola", "cocinero",
    "cuchillo", "maiz", "exprimidor", "ensalada", "espumadera", "freir", "fruteria", "verduleria", "vitroceramica", "puerro",
    "cocinera", "pera", "guindilla", "camarera", "jarra", "jarra_medidora", "nevera", "cuchillo_sierra", "manopla", "mostaza",
    "brocoli", "coliflor", "endivia", "espinacas", "hervir", "horno", "asar", "mayonesa", "ketchup", "pimienta",
    "tomate_frito", "rallador", "servir_agua", "fregar_platos", "comer_yogur", "pelar", "repollo", "morder", "mermelada", "mermelada_fresa",
    "aceitera", "grifo", "olla_presion", "repostero", "desayunar", "pelar_patata", "abrir_bote", "rabanito", "receta", "mazorca",
    "poner_mesa", "aliñar", "sopa", "paella", "abrir_botella", "untar", "vinagrera", "chocolate", "aguacate", "amasar",
    "rebozar", "batir", "cazuela", "rodillo", "guinda", "ciruela", "judias", "col_lombarda", "vinagre", "apio",
    "batidor_manual", "calentar", "verter", "miel", "gota_agua", "granada", "remolacha", "pomelo", "naranja_mitad", "salpimentar",
    "rallar", "platano_pelado", "rabanitos", "sandwich", "tostadora", "olla", "hornillo", "horno_abierto", "cortar_pan", "cortar",
    "coco", "patatas_fritas", "cochinillo", "colador_chino", "mandarina", "albaricoques", "gofrera", "manzana_verde", "manzana_roja", "lima",
    "molde_bizcocho", "molde_tarta", "heladero", "bombona_gas", "helado_copa", "lavar_fruta", "caqui", "papaya", "fuente", "mortero",
    "batido", "exprimir", "cascara_platano", "panaderia", "esparragos_trigueros", "grelos", "habas", "menestra", "saltear", "vapor",
    "leche_polvo", "harina", "azucar", "mantequilla", "perejil", "cucharon", "calor", "empanar", "molde", "frio",
    "freidora", "merendar", "frutas", "verduras", "rodaja_melon", "carne_picada", "cuchillo_cocina", "dar_biberon", "fregadero", "sarten",
    "cebolleta", "ajos", "uva_negra", "hamburguesa", "condimentos", "termometro_cocina", "queso_fresco", "escurridor", "pescaderia", "solomillo",
    "chuleta", "boniato", "masa", "arandanos", "hoguera", "tarta", "nisperos", "frutero", "pan_barra", "vaso_agua",
    "tuberia", "maceta", "brotes", "botella", "fabrica", "pizzero", "hervidor", "granadilla", "colinabo", "bandeja_comida",
    "pimiento_amarillo", "pasta", "wok", "fuente_agua", "parque_infantil", "chirimoya", "chayote", "mesa_puesta"
]
# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('comida.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")