<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotService 
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function handleUserMessage($message)
    {
        // Extraire tous les symptômes détectés
        $symptoms = $this->fetchSymptoms($message);

        if (empty($symptoms['symptoms_en'])) {
            return ["response" => "Je ne reconnais pas ces symptômes. Peux-tu être plus précis ?"];
        }

        Log::info("🩺 Symptômes détectés : " . json_encode($symptoms['symptoms_en']));

        // Envoyer tous les symptômes détectés au modèle
        $diagnosis = $this->predictDisease($symptoms['symptoms_en']);

        // Générer la réponse avec ChatGPT
        $response = $this->generateResponse($symptoms, $diagnosis);

        if (is_array($response)) {
            $response = json_encode($response, JSON_PRETTY_PRINT);
        }
    
        return $response;
    }


    private function fetchSymptoms($message)
    {
        $response = Http::post('http://127.0.0.1:5001/extract_symptoms', [
            'message' => $message,
        ]);

        $data = $response->json();

        Log::info("✅ Symptômes extraits : " . json_encode($data));

        return [
            "symptoms_en" => (array)($data['symptoms_en'] ?? []),
            "symptoms_fr" => (array)($data['symptoms_fr'] ?? [])
        ];
    }


    private function generateResponse($symptoms_fr, $diagnosis)
    {
        Log::info("📨 Symptômes FR envoyés à ChatGPT : " . json_encode($symptoms_fr));
        Log::info("📨 Diagnostic envoyé à ChatGPT : " . $diagnosis);

        $response = Http::post('http://127.0.0.1:5001/generate_response', [
            'symptoms' => $symptoms_fr,  // Envoi de tous les symptômes en FR
            'diagnosis' => $diagnosis,
        ]);

        Log::info("🔍 Réponse brute de ChatGPT : " . json_encode($response->json()));

        if ($response->failed()) {
            return "Je n'ai pas pu générer une explication.";
        }

        return $response->json()['response'] ?? "Je n'ai pas pu générer une explication.";
    }


    private function predictDisease($symptoms)
    {
        $response = Http::post('http://127.0.0.1:5002/predict', [
            'symptoms' => $symptoms,
        ]);

        return $response->json()['diagnosis'] ?? 'Diagnostic inconnu';
    }
}
