<?php

namespace App\Livewire;

use Livewire\Component;
use App\models\Conversation;

class Users extends Component
{
    public $users;

    /**
     * The mount method is like a constructor. It runs when the
     * component is first initialized.
     */
    public function message($userId)
    {
        $authenticatedUserId = auth()->id();

        $existingConversation = Conversation::where( function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $authenticatedUserId)
            ->where('receiver_id', $userId);

        })->orWhere( function ($query) use ($authenticatedUserId, $userId) {
            $query->where( function ($query) use ($authenticatedUserId, $userId) {
                $query->where('sender_id', $userId)
                ->where('receiver_id', $authenticatedUserId);
            });
        })->first();
        // dd($existingConversation);

        if($existingConversation)
        {
            return redirect()->route('chat.chat', ['query' => $existingConversation->id]);
        }

        $createdConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId,
        ]);

        return redirect()->route('chat.chat', ['query' => $createdConversation->id]);
    }

    public function mount($users)
    {
        $this->users = $users->except(auth()->id());
    }
    
    public function render()
    {
        return view('livewire.users');
    }
}
