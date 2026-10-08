import os
import torch
import traceback
from flask import Flask, request, jsonify
from flask_cors import CORS
from PIL import Image, ImageEnhance
from diffusers import StableDiffusionImg2ImgPipeline
from motor_semantico import MiMotorSemantico 

app = Flask(__name__)
CORS(app) 

motor_semantico = MiMotorSemantico()

print("--- CARGANDO MODELO IA... ---")
try:
    model_id = "runwayml/stable-diffusion-v1-5"
    pipe = StableDiffusionImg2ImgPipeline.from_pretrained(model_id, torch_dtype=torch.float32)
    pipe = pipe.to("cpu")
    print("--- MODELO CARGADO CON ÉXITO ---")
except Exception as e:
    print(f"ERROR AL CARGAR MODELO: {e}")

# --- RUTAS DE LA API ---

@app.route('/buscar', methods=['POST'])
def buscar():
    # Validación añadida: Asegura que la petición tenga datos
    data = request.get_json()
    if not data or 'query' not in data:
        return jsonify({"status": "error", "message": "Datos inválidos"}), 400
        
    try:
        print(f"Petición recibida en /buscar: {data}")
        resultado = motor_semantico.buscar(data['query'])
        return jsonify({'ruta_imagen': resultado.path})
    except Exception as e:
        traceback.print_exc()
        return jsonify({"status": "error", "message": str(e)}), 500

@app.route('/api/segmentar', methods=['POST'])
def generar():
    try:
        datos = request.get_json()
        paciente_id = str(datos['id'])
        nombre_original = datos['nombre_archivo'] 
        
        base_dir = os.getcwd()
        ruta_imagen = os.path.join(base_dir, "storage", "pictogramas", "base", nombre_original)
        
        if not os.path.exists(ruta_imagen):
            return jsonify({"status": "error", "message": "Archivo no encontrado"}), 404

        imagen = Image.open(ruta_imagen).convert("RGB")
        imagen = ImageEnhance.Brightness(imagen).enhance(1.2)
        imagen = ImageEnhance.Contrast(imagen).enhance(1.1)
        
        resultado = pipe(
            prompt="simple autism pictogram, clean icon, educational symbol",
            image=imagen,
            strength=0.35,
            guidance_scale=4,
            num_inference_steps=10
        ).images[0]

        ruta_resultado = os.path.join(base_dir, "public", "pictogramas_procesados", f"{paciente_id}_{nombre_original}")
        resultado.save(ruta_resultado)
        
        return jsonify({"status": "éxito", "archivo": f"{paciente_id}_{nombre_original}"}), 200

    except Exception as e:
        traceback.print_exc()
        return jsonify({"status": "error", "message": str(e)}), 500

if __name__ == '__main__':
    # Antes de correr, imprimimos las rutas para confirmar que Flask ve /buscar
    print("Rutas registradas:", [str(rule) for rule in app.url_map.iter_rules()])
    app.run(debug=True, port=5000)

