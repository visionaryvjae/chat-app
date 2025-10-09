<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;

class Chat extends Component
{

    // public $selectedConversation;
    public $query;
    public $selectedConversation;

    public function mount($query) // The route parameter is injected here
{
    // The $query variable now correctly holds the ID from the URL
    $this->query = $query;
    $this->selectedConversation = Conversation::findOrFail($this->query);
}

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
