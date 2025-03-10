<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ChatBotService;

class Chatbox extends Component
{
    public $message = '';
    public $messages = [];
    protected $chatbot;

    public function __construct()
    {
        $this->chatbot = app(ChatBotService::class); // Properly resolve service
    }

    public function sendMessage()
    {
        if (trim($this->message) === '') return;

        // Store user message
        $this->messages[] = ['sender' => 'user', 'text' => $this->message];

        // Call the ChatBot service
        
        $response = $this->chatbot->handleUserMessage($this->message);

        if (is_array($response)) {
            $response = json_encode($response, JSON_PRETTY_PRINT);
        }
        
        // Stocker la réponse du bot
        $this->messages[] = ['sender' => 'bot', 'text' => $response];

        // Effacer l'entrée utilisateur
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chatbox');
    }
}
