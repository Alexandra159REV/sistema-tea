from flask import Flask, request, jsonify
from flask_cors import CORS
from PIL import Image, ImageEnhance
import numpy as np
import torch
import os
from diffusers import StableDiffusionImg2ImgPipeline

app = Flask(__name__)
CORS(app) 

# CARGA EL MODELO
print("--- CARGANDO MODELO IA... ---")
model_id = "runwayml/stable-diffusion-v1-5"
pipe = StableDiffusionImg2ImgPipeline.from_pretrained(model_id, torch_dtype=torch.float32)
pipe = pipe.to("cpu") 

def hex_to_rgb(hex_color):
    hex_color = hex_color.lstrip('#')
    return tuple(int(hex_color[i:i+2], 16) for i in (0, 2, 4))

@app.route('/api/segmentar', methods=['POST'])
def generar():
    try:
        datos = request.json
        paciente_id = str(datos['id'])
        color_hex = datos['color']
        
        base_dir = os.getcwd()
        ruta_imagen = os.path.join(base_dir, "storage", "pictogramas", "base", f"{paciente_id}.png")
        
        if not os.path.exists(ruta_imagen):
            return jsonify({"status": "error", "message": "Archivo no encontrado"}), 404

        imagen = Image.open(ruta_imagen).convert("RGB")
        imagen = ImageEnhance.Brightness(imagen).enhance(1.2)
        imagen = ImageEnhance.Contrast(imagen).enhance(1.1)
        
        img_array = np.array(imagen)
        nuevo_fondo = hex_to_rgb(color_hex)
        mask = (img_array[:,:,0] > 230) & (img_array[:,:,1] > 230) & (img_array[:,:,2] > 230)
        img_array[mask] = nuevo_fondo
        imagen = Image.fromarray(img_array)

        resultado = pipe(
            prompt="simple autism pictogram, clean icon, educational symbol",
            image=imagen,
            strength=0.35,
            guidance_scale=4,
            num_inference_steps=10
        ).images[0]

        ruta_resultado = os.path.join(base_dir, "public", "pictogramas_procesados", f"{paciente_id}_final.png")
        resultado.save(ruta_resultado)
        
        return jsonify({"status": "éxito"}), 200

    except Exception as e:
        return jsonify({"status": "error", "message": str(e)}), 500

if __name__ == '__main__':
    print("--- SERVIDOR LISTO EN http://127.0.0.1:5000 ---")
    app.run(port=5000)