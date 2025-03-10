import os
import numpy as np
import joblib
from flask import Flask, request, jsonify

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
MODEL_PATH = os.path.join(BASE_DIR, "random_forest_model.pkl")
ENCODER_PATH = os.path.join(BASE_DIR, "label_encoder.pkl")

# Charger le modèle et l'encoder
model = joblib.load(MODEL_PATH)
encoder = joblib.load(ENCODER_PATH)

symptom_columns = model.feature_names_in_

# Initialiser Flask
app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict_disease():
    """ Recevoir une liste de symptômes et renvoyer la maladie prédite """
    data = request.get_json()
    symptoms = data.get("symptoms", [])

    if not symptoms:
        return jsonify({"error": "Veuillez fournir des symptômes valides."}), 400

    # Créer un tableau de booléens (0 = pas présent, 1 = présent)
    symptoms_input = np.zeros((1, len(symptom_columns)))

    for symptom in symptoms:
        if symptom in symptom_columns:
            index = list(symptom_columns).index(symptom)
            symptoms_input[0, index] = 1  # Activer le symptôme

    # Prédire la maladie
    predicted_label = model.predict(symptoms_input)
    predicted_disease = encoder.inverse_transform(predicted_label)

    return jsonify({"diagnosis": predicted_disease[0]})

if __name__ == '__main__':
    app.run(port=5002, debug=True)
