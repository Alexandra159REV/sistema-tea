import pandas as pd

# 1. Pegamos aquí las listas que te pasé

ids = [
    "2245", "2314", "2367", "2374", "2574", "2606", "3250", "4550", "7040", "7272",
    "7273", "10192", "10261", "10743", "10750", "11312", "11959", "21020", "20651", "28742",
    "20753", "28754", "28757", "28758", "28761", "28762", "28765", "28766", "28769", "28770",
    "28773", "28774", "28777", "28778", "28781", "28782", "28785", "28786", "28789", "28790",
    "30891", "30620", "31310", "31744", "31840", "31871", "31884", "31925", "31939", "32148",
    "32160", "32170", "32296", "34377", "34409", "34508", "35529", "35531", "35533", "35537",
    "35539", "35545", "35559", "36341", "37002", "37028", "30050", "30250", "38401", "30930",
    "30932", "38936", "39142", "39248", "39269", "39564", "39668", "39056"
]

# Lista de Nombres (78 elementos)
nombres = [
    "aburrido", "preocupado", "enfadado_mucho", "serio", "sorprendido", "triste", "contento", "abrazo", "enfermo_termometro", "pensar_manzana",
    "pensar_agua", "niña_contenta", "asustado_fantasma", "enfadado_pregunta", "triste_pregunta", "nervioso_espera", "niña_triste", "enfadado_brazos_cruzados", "niña_enfadada", "enfermo_cama",
    "dolor_cabeza_niño", "dolor_cabeza_niña", "dolor_muela_niño", "dolor_muela_niña", "dolor_garganta_niño", "dolor_garganta_niña", "dolor_barriga_niño", "dolor_barriga_niña", "dolor_espalda_niño", "dolor_espalda_niña",
    "dolor_brazo_niño", "dolor_brazo_niña", "dolor_oido_niño", "dolor_oido_niña", "dolor_pecho_niño", "dolor_pecho_niña", "dolor_lumbar_niño", "dolor_lumbar_niña", "dolor_gluteo_niño", "dolor_gluteo_niña",
    "asustado_cara", "mareado_1", "mareado_2", "cara_triste_final", "cara_contenta_final", "niña_enfadada", "niño_enfadado", "niño_mareado", "niño_triste", "dolor_estomago_mujer",
    "temblar_miedo", "gritar", "enfermo_termometro_niño", "estornudar", "estornudar_mujer", "estornudar_hombre", "cara_sorpresa", "aburrido_cara", "sonrisa", "cara_triste",
    "cara_enfado", "cara_pena", "pensar_comida", "leer_estudiar", "escala_emociones", "cara_seria", "cara_neutral", "asustado_ruido", "sofoco_calor", "preocupado_niño",
    "cansado_niño", "meditar_enfado", "prohibido_pelear", "cara_panico", "meditar_relajacion", "dolor_pecho_triste", "asustado_temblor", "sudar_calor"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")