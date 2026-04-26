import os

def renombrar_imagenes():

    #  RUTA DE TU CARPETA
    ruta = r"D:\laragon\www\TEA web\tea-laravel\public\pictogramas\rutinas_terapia"

    # DICCIONARIO (TU MAPEO DE ANIMALES)
    #148 fotoss
    mapeo = {
    # Numero : Nombre
    "2317": "casa",
    "2742": "entrar",
    "2806": "salir",
    "3180": "caravana",
    "5913": "libreta",
    "6491": "abrir_puerta",
    "6606": "cerrar_puerta",
    "6964": "casita",
    "9814": "pupitre_derecha",
    "9815": "pupitre_izquierda",
    "10258": "colegio_patio",
    "10259": "colegio_fachada",
    "10260": "estudiar_numeros",
    "11245": "estudiar_biologia",
    "13634": "estudiar_musica",
    "15734": "clase_teoria",
    "15925": "reunion_padres",
    "22771": "clase_baile",
    "22777": "baile_pareja",
    "23400": "cantar_coro",
    "24469": "banderas_idiomas",
    "24471": "clase_religion",
    "24679": "tener_idea",
    "24680": "recordar",
    "24947": "iglesia",
    "25552": "terapia_grupo",
    "26811": "sala_espera",
    "27067": "entrar_baño",
    "27278": "escalera_piscina_1",
    "27279": "escalera_piscina_2",
    "27280": "escalera_piscina_3",
    "28225": "dormitorio",
    "28687": "entrar_casa",
    "28689": "salir_casa",
    "28926": "chalet",
    "29845": "familia_casa",
    "29847": "vecinos",
    "31374": "llamar_puerta",
    "32352": "visita_abuela",
    "32546": "portatil_lectura",
    "32548": "portatil_juego",
    "32550": "portatil_dibujo",
    "32554": "clase_matematicas",
    "32697": "clase_latin",
    "32705": "clase_ingles",
    "32798": "casa_seccion",
    "32940": "mudanza",
    "33072": "aula_vacia",
    "34709": "videollamada_clase",
    "34798": "clase_online_pantalla",
    "35433": "solfa_online",
    "35434": "pizarra_musica",
    "36361": "estudiar_medicina",
    "36362": "estudiar_biologia_celular",
    "36363": "estudiar_geometria",
    "36364": "estudiar_economia",
    "36365": "estudiar_psicologia",
    "36366": "estudiar_botanica",
    "36367": "geografia_francia",
    "36368": "geografia_mundo",
    "36369": "geografia_españa",
    "36370": "estudiar_historia",
    "36371": "geografia_continentes",
    "36372": "estudiar_literatura",
    "36373": "estudiar_filosofia",
    "36374": "estudiar_tecnologia",
    "36375": "estudiar_quimica",
    "36457": "psicoterapia_individual_1",
    "36458": "psicoterapia_individual_2",
    "36459": "psicoterapia_individual_3",
    "36461": "psicoterapia_pareja_1",
    "36462": "psicoterapia_pareja_2",
    "36465": "tienda_muebles",
    "36485": "alumno_concentrado",
    "36486": "alumno_cansado",
    "36489": "alumno_escribiendo",
    "36636": "baloncesto_colegio",
    "37060": "biblioteca",
    "37428": "fisioterapia_pierna",
    "37545": "informatica_robot",
    "37740": "clase_aleman",
    "39047": "pizarra_verde",
    "39170": "pizarra_cruz",
    "39200": "casa_pueblo",
    "39265": "nido_pajaro",
    "39397": "bañarse_bebe_1",
    "39398": "bañarse_bebe_2",
    "39606": "examen_aula"
}
    archivos = os.listdir(ruta)

    renombrados = 0
    ya_existen = 0
    faltantes = []

    for archivo in archivos:
        if not archivo.lower().endswith(('.png', '.jpg', '.jpeg')):
            continue

        nombre_original, ext = os.path.splitext(archivo)

        #  LIMPIEZA MÁGICA: Quitamos "arasaac_" si existe para quedarnos solo con el número
        numero = nombre_original.replace("arasaac_", "").strip()

        # Si después de limpiar no es un número, lo saltamos (por si hay otros archivos)
        if not numero.isdigit():
            continue

        if numero in mapeo:
            nuevo_nombre = mapeo[numero] + ext
            origen = os.path.join(ruta, archivo)
            destino = os.path.join(ruta, nuevo_nombre)

            if os.path.exists(destino):
                print(f" Ya existe: {nuevo_nombre}")
                ya_existen += 1
                continue

            try:
                os.rename(origen, destino)
                print(f" {archivo} -> {nuevo_nombre}")
                renombrados += 1
            except Exception as e:
                print(f" Error con {archivo}: {e}")
        else:
            faltantes.append(numero)

    print("\n--- RESUMEN ---")
    print(f" Renombrados: {renombrados}")
    print(f" Ya existían: {ya_existen}")
    print(f" Faltantes: {len(set(faltantes))}")

    #  GENERA AUTOMÁTICAMENTE LOS QUE FALTAN
    if faltantes:
        print("\n--- COMPLETAR DICCIONARIO ---\n")
        for f in sorted(set(faltantes)):
            print(f'"{f}": "",')


if __name__ == "__main__":
    renombrar_imagenes()