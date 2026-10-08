import sys
import json
import os
import torch
from PIL import Image, ImageEnhance
from diffusers import AutoPipelineForImage2Image


def procesar():
    # 1. Recibir datos desde PHP como JSON
    try:
        datos = json.loads(sys.argv[1])
        ruta_entrada = datos['imagen']
        prompt = datos['prompt']
        brillo = datos['brillo']
        contraste = datos['contraste']
        fondo_hex = datos['fondo']
        # Se mantiene la variable nombre_salida, pero ahora se usará como parte del nombre
        nombre_salida = datos['palabra'] 
        paciente_id = datos['paciente_id'] # NUEVO: ID para la nomenclatura
    except Exception as e:
        print(f"Error al leer JSON: {e}")
        sys.exit(1)

    # 2. Procesamiento de imagen
    try:
        imagen = Image.open(ruta_entrada).convert("RGB")
        
        # Aplicar ajustes básicos de PIL (Brillo/Contraste)
        imagen = ImageEnhance.Brightness(imagen).enhance(brillo)
        imagen = ImageEnhance.Contrast(imagen).enhance(contraste)
        
        # 3. Motor IA (Diffusers)
        modelo = "stabilityai/sdxl-turbo"
        pipe = AutoPipelineForImage2Image.from_pretrained(
            modelo, torch_dtype=torch.float16, variant="fp16"
        ).to("cuda")
        
        resultado = pipe(
            prompt=prompt, 
            image=imagen, 
            strength=0.5, 
            guidance_scale=0.0, 
            num_inference_steps=2
        ).images[0]

        # 4. Guardar archivo con nueva nomenclatura: {paciente_id}_{nombre_salida}.png
        nombre_archivo_final = f"{paciente_id}_{nombre_salida}.png"
        ruta_salida = os.path.join(os.path.dirname(os.path.dirname(ruta_entrada)), "public", "pictogramas_procesados", nombre_archivo_final)
        
        os.makedirs(os.path.dirname(ruta_salida), exist_ok=True)
        resultado.save(ruta_salida)
        
        print(ruta_salida) # Esto es lo que Laravel captura
        
    except Exception as e:
        print(f"Error IA: {e}")
        sys.exit(1)

if __name__ == "__main__":
    procesar()