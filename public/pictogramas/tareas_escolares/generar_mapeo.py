import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2348", "2359", "2380", "2387", "2409", "2440", "2450", "2475", "3082", "4696",
    "4965", "6454", "6474", "6495", "6641", "6874", "7004", "7141", "8107", "8165",
    "8216", "9060", "9080", "9220", "9223", "10312", "11371", "11372", "12297", "16155",
    "16341", "16799", "21851", "24615", "24771", "25191", "26589", "27260", "27269", "27270",
    "27411", "28643", "29853", "29907", "29911", "29917", "30872", "30873", "30874", "30875",
    "30876", "30877", "30878", "30879", "31680", "32308", "32446", "32814", "34782", "34790",
    "35979", "36257", "36447", "37093", "37189", "37225", "37358", "37406", "37407", "37518",
    "37519", "37896", "38265", "38610", "38612", "38695", "38700", "39018", "39115", "39661",
    "39687", "39688"
]

nombres = [
    "pintar_sol", "cuaderno", "escribir_abc", "estudiar_concentrado", "borrador_goma", "lapiz", "libro_cerrado", "mochila", "colegio_escuela", "mochila_senderismo",
    "tizas_pizarra", "biblioteca", "sacar_libro_estanteria", "estudiar_biblioteca", "fichas_educativas", "abrir_libro", "leer_cuento", "escribir_pizarra", "guardar_en_mochila", "sacar_de_mochila",
    "mochila_escolar", "leer_recetario", "memoria_usb", "libro_naturaleza", "maletin", "escribir_lapiz", "sentarse_en_circulo", "reunion_circulo", "leer_braille", "señalar_libro",
    "borrador_pizarra", "pasaporte", "teclado_computadora", "arquitecto_planos", "entregar_libro", "libro_abierto", "familia_paseo", "sentarse_borde_piscina", "sentarse_borde_piscina_niño", "sentarse_perfil",
    "rellenar_formulario", "leer_niña", "recoger_juguetes", "aula_musica", "aula_idiomas", "aula_ciencias", "profesora_clase_2", "profesor_clase_2", "profesora_clase_1", "profesor_clase_1",
    "cura_clase_1", "monja_clase_1", "cura_clase_2", "monja_clase_2", "leer_niño_color", "duda_lectura", "aula_vacia", "estudiar_examen", "ordenar_escritorio", "dar_clase_pizarra",
    "estudiar_cansado", "buscar_en_diccionario", "sacapuntas_lapiz", "computadora_escritorio", "sacar_punta", "clase_musica_pizarra", "huella_digital_lector", "firmar_documento", "marcar_opcion", "mochila_puesta_bien",
    "mochila_puesta_mal", "colgar_mochila", "mochila_espalda", "ordenar_libros", "carpeta_anillas", "cerrar_mochila", "abrir_mochila", "escanear_codigo_qr", "mochila_en_suelo", "patio_recreo",
    "leer_atentamente", "maleta_viaje"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")