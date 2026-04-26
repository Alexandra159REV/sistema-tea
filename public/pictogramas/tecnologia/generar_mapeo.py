import pandas as pd

# 1. Pegamos aquí las listas que te pasé

# Lista de IDs (Tecnología)
ids = [
    "2354", "2487", "2546", "2793", "2820", "5912", "5915", "6201", "7190", "7214",
    "8293", "9131", "9132", "9160", "9165", "9860", "9872", "11208", "21945", "22801",
    "23823", "25369", "25498", "25614", "26186", "28561", "28845", "29151", "30225", "34621",
    "34908", "34910", "34939", "36357", "36864", "36865", "36866", "37464", "37514", "38209",
    "38333", "38691", "39238", "39251", "39465", "39518"
]

# Lista de Nombres (Tecnología)
nombres = [
    "consola_videojuegos", "computadora_escritorio", "raton_computadora", "teclado", "raton_clic", "audifono_sordo", "auriculares_grandes", "calculadora", "computadora_torre", "laptop_portatil",
    "microfono_solapa", "videojuego_pacman", "videojuego_tetris", "pantalla_tactil", "laptop_abierta", "clic_izquierdo", "clic_derecho", "auriculares_diadema", "disco_videojuego", "teclear_escribir",
    "bateria_pila", "pulsador_raton", "monitor_pantalla", "pelicula_dvd", "usar_raton", "mano_raton", "raton_dibujo", "tablet_jugar", "tablet_contraseña", "pantalla_rota_color",
    "pantalla_rota_tablet", "prohibido_camara", "cargar_bateria", "auriculares_proteccion", "pantalla_proteccion_monigote", "pantalla_proteccion_mujer", "pantalla_proteccion_hombre", "computadora_mando", "computadora_teclado_raton", "teclado_dispositivo",
    "cargar_dispositivo", "pantalla_verde_croma", "auriculares_inalambricos", "pantalla_completa", "minimizar_pantalla", "maquina_arcade"
]

# 2. Creamos un DataFrame (como una tabla de Excel)
df = pd.DataFrame({
    'numero': ids,
    'nombre': nombres
})

# 3. Exportamos a CSV con codificación UTF-8 para evitar errores de símbolos
df.to_csv('animales.csv', index=False, encoding='utf-8')

print("¡Archivo acciones.csv generado con éxito!")