import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (Vestimenta)
ids = [
    "2242", "2270", "2279", "2280", "2289", "2298", "2303", "2308", "2309", "2310",
    "2311", "2319", "2332", "2336", "2366", "2391", "2415", "2436", "2522", "2565",
    "2572", "2576", "2601", "2613", "2622", "2668", "2691", "2698", "2718", "2723",
    "2775", "2781", "2833", "2846", "3109", "3229", "3242", "3278", "3296", "4680",
    "4712", "4741", "4750", "4872", "4885", "4927", "5065", "5357", "5369", "5380",
    "5404", "5440", "5469", "5496", "5506", "5593", "5602", "5904", "5944", "5962",
    "5985", "5986", "6216", "6239", "6240", "6620", "6623", "6627", "6986", "7015",
    "7021", "7122", "7123", "7151", "7193", "7225", "7233", "7706", "7815", "8038",
    "8122", "8135", "8279", "8281", "8291", "8339", "8353", "8358", "8466", "8531",
    "8536", "8589", "8637", "8697", "8698", "8701", "8720", "8728", "8895", "9147",
    "9169", "9197", "9918", "9920", "9923", "9925", "10143", "10180", "10352", "10354",
    "11232", "11306", "11384", "13638", "13640", "13642", "14538", "14540", "15371", "15497",
    "15499", "15513", "15808", "15842", "16321", "16323", "16335", "16861", "16897", "17026",
    "17233", "17288", "21518", "21910", "21996", "21998", "22100", "22110", "22175", "22192",
    "23921", "24165", "24222", "24276", "24308", "24881", "25016", "25095", "25099", "25610",
    "25680", "25746", "25804", "25875", "25908", "26487", "27049", "27052", "27288", "27298",
    "27566", "27817", "27881", "27978", "28029", "28219", "28275", "29841", "29899", "29923",
    "29933", "29977", "30152", "30154", "30155", "30158", "30160", "30424", "30425", "30426",
    "30427", "30436", "30437", "30474", "30475", "30476", "30973", "31052", "31053", "31119",
    "31213", "31217", "31258", "31260", "31262", "31268", "31362", "31364", "31366", "31476",
    "31666", "32135", "32316", "32317", "32570", "32671", "32922", "32923", "33046", "33133",
    "33137", "33138", "33139", "34019", "34021", "34022", "34135", "34149", "34494", "34569",
    "34635", "34637", "34655", "34659", "34663", "34669", "34671", "34691", "34701", "34711",
    "34735", "34737", "34739", "34761", "34836", "34838", "34884", "35099", "35333", "35387",
    "35819", "35909", "36213", "36219", "36357", "36358", "36382", "36383", "36423", "36435",
    "36461", "36466", "36471", "36596", "36597", "36606", "36607", "36626", "36643", "36648",
    "36724", "36787", "36788", "36789", "36790", "36791", "36792", "36793", "36840", "36846",
    "36855", "36856", "36857", "36858", "36861", "36862", "36863", "36876", "36930", "36990",
    "36991", "37004", "37055", "37066", "37067", "37205", "37254", "37299", "37338", "37339",
    "37340", "37342", "37414", "37421", "37429", "37430", "37516", "37763", "37816", "37817",
    "37818", "37857", "37893", "37894", "37895", "37919", "37934", "37935", "37938", "37944",
    "37945", "38013", "38045", "38134", "38135", "38204", "38239", "38584", "38693", "38696",
    "38697", "38719", "38754", "38755", "38763", "38866", "39029", "39126", "39212", "39213",
    "39240", "39253", "39259", "39449", "39452", "39534", "39548", "39623", "39649", "39694",
    "39702", "39788"
]

# Lista de Nombres (Vestimenta)
nombres = [
    "abrigo_largo", "bañador_mujer", "bikini", "albornoz", "bragas", "calcetines", "calzoncillos", "camisa", "camiseta_manga_corta", "camiseta_tirantes",
    "camison", "chaqueta", "chandal", "cinturon", "delantal", "falda", "guantes", "jersey", "pijama", "pantalones",
    "sombrero", "sujetador", "pantalones_cortos", "vestido", "zapatos", "boton", "casco_obra", "chaleco", "corona", "falda_v2",
    "zapato_tacon", "gorra", "pinzas_ropa", "percha", "gorro_navidad", "bata_colegio", "galan_noche", "leotardos", "traje_hombre", "calcetin",
    "pajarita", "pantalones_v2", "ropa_sucia", "chaqueta_v2", "tienda_ropa", "chubasquero", "bota_navidad", "abrochar_boton", "gabardina", "subir_cremallera",
    "disfraz_bruja", "desabrochar_boton", "disfraz_fantasma", "meter_ropa_lavadora", "tender_ropa", "coser_parche", "vaquero", "antifaz", "mascara_careta", "cinturon_seguridad",
    "disfraz_mariquita", "disfraz_hada", "chistera", "disfraz_vampiro", "varita_magica", "camiseta_manga_larga", "tienda_ropa_niño", "disfraz_diablo", "abrochar_cremallera", "cerrar_cremallera",
    "carrete_hilo", "guantes_invierno", "guantes_boxeo", "camiseta_mancha", "pantalones_v3", "tela_rayas", "falda_niña", "parche_ojo", "gorro_fiesta", "bata_medica",
    "abrigo_invierno", "disfraz_gorila", "disfraz_duende", "mono_trabajo", "aguja_imperdible", "media", "guante_v2", "media_v2", "pinza_madera", "bate_beisbol",
    "traje_bombero", "garfio_pirata", "nariz_payaso", "sombrero_bruja", "antifaz_v2", "impermeable_verde", "bota_roja", "protesis_pierna", "peluca_payaso", "guantes_boxeo_rojos",
    "mascarilla_proteccion", "abrigo_marron", "camiseta_azul", "camiseta_manga_larga_azul", "camiseta_verde", "camiseta_blanca", "subir_pantalones", "bajar_pantalones", "pamela", "casco_vikingo",
    "desnudarse", "disfraz_dinosaurio", "cremallera", "pantalones_cortos_v2", "camisa_v2", "camisa_flores", "codera", "rodillera", "camison_v2", "corsé",
    "sujetador_v2", "quitar_falda", "falda_v3", "falda_v4", "estante_ropa", "camisa_v3", "planchar_camisa", "doblar_ropa", "quitar_chaqueta", "atar_cordones",
    "bufanda_verde", "bufanda_rosa", "casco_bombero", "gorra_policia", "probador", "tienda_ropa_v2", "poner_lavadora", "cesto_ropa_sucia", "niño_vestido", "camisa_vaquera",
    "disfraz_pirata", "mascaras_teatro", "vaqueros_v2", "peto_vaquero", "polo_rayas", "sudadera_niño", "corona_oro", "vestido_novia", "traje_novio", "zapatos_v2",
    "ropa_interior_hombre", "camisa_manga_larga_v2", "sudadera_verde", "disfraz_mago", "jersey_azul", "colgar_ropa", "disfraz_superheroe", "disfraz_superheroina", "faja_lumbar", "peto_trabajo",
    "cinturon_v2", "guantes_blancos", "mascara_gas", "anorak_azul", "quitar_calcetin", "subir_pantalones_v2", "gafas_proteccion", "tienda_ropa_v3", "tienda_ropa_v4", "perchero_ruedas",
    "peto_azul", "tienda_ropa_v5", "maniqui_mujer", "maniqui_hombre", "maniqui_niño", "maniqui_bebe", "maniqui_niña", "tienda_ropa_v6", "tienda_ropa_v7", "tienda_ropa_v8",
    "tienda_ropa_v9", "uniforme_trabajo", "tienda_ropa_v10", "ombligo", "faja_medica", "sonda_estomacal", "sombrero_mexicano", "zapato_tacon_rojo", "zapato_marron_dolor", "cinturon_tachuelas",
    "silueta_niña_ropa_interior", "silueta_niño_ropa_interior", "silueta_mujer_ropa_interior", "silueta_hombre_ropa_interior", "silueta_anciana_ropa_interior", "silueta_anciano_ropa_interior", "disfraz_tiroles_hombre", "disfraz_tiroles_mujer", "calzon_tiroles", "vestirse_pantalones",
    "subir_pantalones_v3", "quitarse_camiseta", "abrochar_gemelo", "abrochar_cinturon_seguridad", "jersey_verde_collar", "horca_campesino", "zapato_tacon_rojo_v2", "zapato_marron", "pañuelo_cuello_nubes", "silueta_niño_interior_frontal",
    "silueta_niña_interior_frontal", "bañador_competicion_hombre", "silueta_niño_interior_v2", "ponerse_calcetin", "ponerse_camiseta_niño", "ponerse_camiseta_niña", "disfraz_ninja", "falda_y_zapatos_rojos", "ponerse_chaqueta_niño", "ponerse_chaqueta_hombre",
    "silueta_mujer_interior_frontal", "silueta_hombre_interior_frontal", "silla_coche_bebe", "abrochar_cinturon_silla", "desabrochar_cinturon_silla", "silla_coche_vacia", "silla_coche_bebe_v2", "silla_coche_bebe_v3", "capa_azul", "tienda_disfraces",
    "niña_vestido_rosa", "niño_pantalones_cortos", "conjunto_interior_niña", "silla_coche_bebe_v4", "maniqui_hombre_v2", "maniqui_mujer_v2", "tienda_disfraces_v2", "conjunto_jersey_pantalon", "gorro_cocinero", "gorro_cocinero_v2",
    "armario_abierto", "sombrero_explorador", "botas_montaña", "disfraz_mosquetero", "auriculares_proteccion_v2", "chubasquero_azul", "disfraz_bruja_v2", "disfraz_ninja_v2", "pantalones_rectos", "buzon_correos",
    "escaparate_tienda", "tienda_disfraces_v3", "vestido_flores", "quitarse_calcetin_v2", "quitarse_pantalones", "zueco_sanitario", "bañador_natacion_mujer", "tunica_negra", "tunica_roja", "tunica_rosa",
    "poner_lavadora_v2", "mascarilla_ffp2", "mascarilla_ffp2_v2", "mascarilla_quirurgica", "mascarilla_quirurgica_v2", "mascarilla_tela_azul", "mascarilla_tela_azul_v2", "body_bebe", "coser_a_maquina", "traje_proteccion_epi",
    "guante_goma_azul", "guante_goma_azul_v2", "quitarse_guante", "guante_azul_mano", "ponerse_guante", "patucos_quirurgicos", "pantalla_proteccion", "calzado_seguridad", "suela_zapato", "disfraz_pastor",
    "disfraz_pastora", "disfraz_mesonera", "abrochar_botones_v2", "abrochar_botones_v3", "abrochar_botones_v4", "doblar_sabana", "botones_presion", "prohibido_ropa_interior", "ponerse_corbata", "ponerse_crema",
    "corbata_payaso", "zapatos_bebe_rojos", "ponerse_chaqueta_v2", "ponerse_capa", "atar_lazo_pelo", "atar_lazo_pelo_v2", "disfraz_demonio", "pañuelo_pirata", "subir_cremallera_pantalon", "bajar_cremallera_pantalon",
    "ponerse_casco_proteccion", "casco_antiruido", "tunica_maga", "túnica_mago", "ponerse_jersey", "disfraz_maga", "atar_cordones_v2", "atar_cordones_v3", "armario_ropa", "cesto_ropa_limpia",
    "cesto_ropa_vacia", "zapatillas_casa", "boina_roja", "tienda_ropa_v11", "ropa_doblada_pila", "gorro_quirurgico", "quitarse_pantalones_v2", "lavar_ropa_mano", "zapato_negro", "chaqueta_cocinero",
    "gorro_cocinero_v3", "contenedor_reciclaje_ropa", "flecha_abajo_circulo", "flecha_arriba_circulo", "traje_karate", "esmoquin", "chaleco_punto_azul", "chaleco_reflectante", "hacer_nudo", "hacer_lazo",
    "bata_blanca_logo", "tunica_arabe", "percha_v2", "tender_ropa_v2", "pantalones_deporte_azul", "chaleco_acolchado_verde", "atar_cordones_v4", "mancha_en_camiseta", "calzoncillo_blanco", "traje_gris_ejecutivo",
    "sujetador_deportivo", "tienda_ropa_v12"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")