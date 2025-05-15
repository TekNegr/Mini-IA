# 🤖 Mini-IA — ChatBot Médical Intelligent

Projet académique visant à développer et intégrer une Intelligence Artificielle dans une application web complète. L’objectif est de concevoir un assistant médical capable de comprendre les symptômes d’un utilisateur exprimés en langage naturel, de prédire un diagnostic, puis de générer une réponse contextualisée grâce à un modèle LLM.

> 🧠 Technologies principales : Laravel 11, Flask, Python, RandomForest, HuggingFace/g4f

---
## Auteurs 

- Henintsoa **RAMAKAVELO** 
- Hector **KOMBOU DJOUKWE** 
- Timothé **RAJANELSON** 
- Enzo **MICHON**

---

## 📌 Fonctionnalités

- 🩺 Prédiction de maladies à partir de symptômes (modèle RandomForest)
- 💬 Génération de réponses naturelles via modèle LLM (HuggingFace/g4f)
- 🔍 Extraction automatique des symptômes depuis un message libre
- 🌐 Interface utilisateur fullstack Laravel + Livewire
- 🔁 Communication Laravel ↔ Python via Flask API

---

## ⚙️ Technologies utilisées

### 🔍 Modèles IA :
- **Modèle Prédictif :** `RandomForest` entraîné sur le dataset *Symbipredict2023* (Kaggle)
- **Modèle LLM :** HuggingFace Transformers et/ou `g4f` pour la génération de réponses en langage naturel

### 🧠 Environnement IA :
- `Python 3.10+`, `scikit-learn`, `pandas`, `Flask`, `Google Colab` pour entraînement et hébergement de l’IA

### 🌐 Application Web :
- `Laravel 11`, `Livewire`, `Tailwind CSS`
- Communication entre backend PHP et modèles IA via API REST Flask (ports 5001/5002)

---

## 🛠️ Guide d'installation et d'exécution

### 1. 🔽 Cloner le projet

```bash
git clone https://github.com/TekNegr/Mini-IA.git
cd Mini-IA
```

---

### 2. ⚙️ Installation des dépendances

#### Backend Laravel (Laravel 11)

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
```

#### Backend IA (Python)

```bash
cd scripts
pip install -r requirements.txt
```

---

### 3. 🚀 Lancement de l’application

#### A. Lancer les scripts Flask

Dans deux terminaux séparés :

```bash
# Terminal 1
python scripts/chat.py  # Port 5001

# Terminal 2
python scripts/predict.py  # Port 5002
```

#### B. Lancer le serveur Laravel

Assurez-vous que **Apache** et **MySQL** (ex : via XAMPP) sont actifs.

```bash
php artisan serve --port=5000
```

---

### 4. 🌐 Accéder à l’application

Rendez-vous sur :

```
http://localhost:5000
```

L’application est maintenant pleinement opérationnelle.

---

## 📂 Structure du projet

```text
Mini-IA/
├── app/                 # Code Laravel principal
├── public/
├── routes/
├── resources/           # Vues + composants Livewire
├── scripts/             # Fichiers Python : chat.py, predict.py
│   └── requirements.txt
└── .env                 # Configuration Laravel
```

---

## 📄 Licence

Projet à but éducatif pour l' **ECE PARIS** – Libre d’usage dans le cadre académique ou expérimental. Pour tout usage commercial, veuillez contacter les auteurs: 

