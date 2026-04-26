import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2271", "2371", "2443", "2512", "2566", "2593", "2694", "2695", "2699", "2928",
    "2964", "3351", "4758", "4873", "4878", "5496", "5609", "5953", "6058", "6912",
    "6971", "7049", "8094", "8389", "8616", "8726", "8727", "8975", "8976", "9977",
    "9008", "9009", "9143", "9830", "10137", "10267", "10372", "10373", "10374", "10375",
    "10376", "10377", "10378", "10379", "10380", "10381", "10382", "10383", "10384", "10385",
    "10386", "10387", "11744", "11745", "11963", "13042", "13044", "13046", "13048", "13050",
    "13052", "13054", "13056", "13058", "13060", "13062", "13064", "13066", "13068", "13070",
    "13072", "15736", "15810", "15812", "15814", "16803", "17269", "17271", "21962", "22029",
    "23405", "25171", "25843", "25844", "25845", "26744", "26803", "26947", "27475", "27489",
    "27559", "27561", "27720", "27869", "27071", "28213", "29034", "29036", "29052", "29210",
    "29736", "29746", "29748", "29750", "29834", "29835", "30150", "30508", "30520", "30524",
    "30614", "31853", "31880", "32162", "32576", "33921", "33924", "33934", "33935", "33936",
    "34294", "34611", "34775", "34777", "34826", "35037", "35405", "35729", "35977", "36349",
    "36511", "36524", "36525", "36542", "36552", "36555", "36652", "36653", "36760", "36761",
    "36825", "36860", "36918", "36933", "37030", "37031", "37032", "37033", "37263", "37312",
    "37314", "37331", "37384", "37401", "37402", "37409", "37410", "37710", "37811", "37866",
    "37904", "38053", "38230", "38242", "38409", "38541", "38611", "38625", "38626", "38627",
    "38726", "38813", "39053", "39202", "39211", "39216", "39766", "3368", "4619"
]

nombres = [
    "bañarse_bebe", "ducha_niño", "lavarse_manos_niño", "peinarse_niño", "secarse_manos_toalla", "toalla_colgada", "barrer_escoba", "cepillo_dientes", "cepillo_pelo", "bote_jabon",
    "mano_abierta", "pastilla_jabon", "secarse_manos_papel", "toalla_playa", "crema_tubo", "plumero_limpiar", "lavadora", "cepillo_uñas", "cepillo_ropa", "bañarse_adulto",
    "peine_y_jabon", "hacer_pompas", "mascarilla_facial", "enjuagarse_boca", "dispensador_jabon", "soplador_pompas", "lavarse_cara", "ponerse_gafas", "limpiar_zapato", "lavarse_manos_adulto",
    "lavarse_pelo", "enjuagarse_pelo", "limpiar_ventana", "limpiar_espejo", "cepillo_electrico", "manos_sucias", "manos_limpias", "muela_limpia", "ejercicio_brazos_cintura", "ejercicio_brazos_pecho",
    "ejercicio_brazos_abajo", "ejercicio_brazos_juntos", "ejercicio_brazos_estirados", "ejercicio_brazos_nuca", "ejercicio_brazos_cruzados", "ejercicio_brazos_hombros", "estiramiento_espalda", "ejercicio_brazos_arriba", "ejercicio_brazos_flexion", "ejercicio_brazos_rectos",
    "ejercicio_manos_cintura", "ejercicio_manos_cadera", "ejercicio_manos_nuca_2", "ejercicio_manos_arriba_2", "prohibido_cepillar", "colgar_toalla", "limpiar_cepillo", "ejercicio_manos_cintura", "ejercicio_brazos_cintura", "ejercicio_brazos_pecho",
    "ejercicio_brazos_frente", "ejercicio_brazos_abajo", "ejercicio_brazos_juntos", "ejercicio_brazos_estirados", "ejercicio_brazos_nuca", "ejercicio_brazos_cruzados", "estiramiento_espalda", "ejercicio_manos_espalda", "ejercicio_brazos_arriba", "ejercicio_brazos_flexion",
    "ejercicio_brazos_rectos", "lavadora", "baño_discapacitados_1", "baño_discapacitados_2", "baño_discapacitados_3", "limpiar_espejo", "limpiar_tabla", "secarse_cara", "limpiar_cepillo", "peinarse_pelo_largo",
    "pasos_lavado_pelo", "jabon_en_jabonera", "bañarse_piscina_mujer", "bañarse_piscina_niño", "bañarse_piscina_hombre", "cepillo_electrico_mano", "ducha_lateral", "lavar_pelo_niño", "inodoro_discapacitados", "cepillarse_dientes_niña",
    "baño_hombre", "baño_mujer", "lavarse_pelo_ducha", "orinar_niña", "limpiar_zapato_betun", "baño_mixto", "ponerse_crema_manos", "cepillo_uñas_azul", "secarse_manos_toalla_verde", "jabon_liquido_mano",
    "limpiar_gafas", "limpiar_ventana_mujer", "limpiar_espejo_mujer", "orinar_niño", "limpiar_oido_bastoncillo", "gotas_oido", "poner_curita", "lavarse_manos_jabon", "secarse_manos_toalla_verde_2", "bote_jabon_y_peine",
    "pasta_y_cepillo_dientes", "bañar_bebe_bañera", "lavarse_dientes_niño", "ducha_niño", "aseo_cuerpo", "jabon_jabonera", "dispensador_papel", "baño_clinica", "baño_discapacitados", "baño_mixto",
    "lavar_verdura", "bañarse_sentado", "lavarse_cara_mujer", "lavarse_cara_niño", "lavarse_cara_manos", "secarse_pelo", "lavar_pelo_niña", "muela_limpia", "dispensador_jabon_1", "dispensador_jabon_2",
    "peine_neceser", "lavar_pelo_peluqueria", "inodoro_niña", "inodoro_niño", "orinar_hombre", "jabon_liquido_1", "jabon_liquido_2", "biberon_bebe", "escobilla_baño", "lavarse_manos_1",
    "lavarse_manos_2", "secarse_pies", "ponerse_crema_pie", "secarse_manos_aire", "lavarse_manos_palmas", "lavarse_manos_dorso", "lavarse_manos_uñas", "lavarse_manos_dedos", "piscina_inflable", "manos_limpias",
    "manos_entrelazadas", "baño_hombres_mujeres", "limpiar_ombligo", "inodoro_limpiar", "inodoro_abierto", "dispensador_papel_vertical", "prohibido_jabon", "inodoro_lateral", "limpiar_espejo", "lavarse_manos_infantil",
    "inodoro_discapacitados_mujer", "levantar_brazos", "desodorante_rollon", "tensiometro", "niño_inodoro_ayuda", "neceser_azul", "lavar_pies", "baño_niños", "baño_niñas", "inodoro_infantil_1",
    "inodoro_infantil_2", "limpiar_mueble", "cepillo_dientes_rojo", "limpiar_oreja", "usar_pañuelo", "toallitas_humedas", "dentista_revision", "cortar_pelo", "tirar_cadena"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")