from buscador_semantico import encontrar_pictograma_ollama, verificar_archivo_fisico

# Definimos un "perfil de prueba" con palabras que un niño o padre usaría
# vs. lo que tú esperas que la IA encuentre en tu diccionario
pruebas_de_usuario = {
    "cepillito": "cepillo_de_dientes",
    "jaboncito": "pastilla_jabon",
    "bañarse": "bañarse",
    "ducha": "bañarse",        # Sinónimo semántico
    "alberca": "bañador",      # Relación por contexto 
    "lavar dientes": "lavarse_los_dientes",
    "limpiar manos": "None"    # Caso donde no debería encontrar coincidencia exacta
}

def ejecutar_perfil_test():
    total = len(pruebas_de_usuario)
    aciertos = 0
    
    print(f"{'ENTRADA USUARIO':<20} | {'IA ENCONTRÓ':<20} | {'ESTADO'}")
    print("-" * 60)
    
    for entrada, esperado in pruebas_de_usuario.items():
        resultado_ia = encontrar_pictograma_ollama(entrada)
        
        # Verificamos si la IA acertó y si el archivo existe físicamente
        existe = verificar_archivo_fisico(resultado_ia) if resultado_ia != "None" else False
        
        if resultado_ia.lower() == esperado.lower():
            status = " ACIERTO"
            aciertos += 1
        else:
            status = " FALLO"
            
        archivo_status = "(Archivo OK)" if existe else "(Sin archivo)"
        print(f"{entrada:<20} | {resultado_ia:<20} | {status} {archivo_status}")

    print("-" * 60)
    print(f"Precisión del Perfil: {(aciertos/total)*100:.2f}%")

if __name__ == "__main__":
    print("Iniciando validación de reconocimiento semántico para Tesis...")
    ejecutar_perfil_test()