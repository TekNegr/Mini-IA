<div class="flex flex-col h-screen bg-gray-100 p-4">
    <!-- Chat Messages Container -->
    <div class="flex-grow overflow-y-auto bg-white p-4 rounded-lg shadow-md">
        @foreach ($messages as $message)
            <div class="p-2 mb-2 rounded-lg 
                {{ $message['sender'] === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' }}">
                <strong>{{ ucfirst($message['sender']) }}:</strong> {{ $message['text'] }}
            </div>
        @endforeach
    </div>

    <!-- Message Input -->
    <div class="mt-4 flex">
        <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
            class="flex-grow p-2 border rounded-lg" placeholder="Type a message...">
        <button wire:click="sendMessage"
            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Send</button>
    </div>
</div>
