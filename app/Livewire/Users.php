<?php

namespace App\Livewire;

use Livewire\Component;

class Users extends Component
{
    public $users;

    /**
     * The mount method is like a constructor. It runs when the
     * component is first initialized.
     */
    public function mount($users)
    {
        $this->users = $users;
    }
    
    public function render()
    {
        return view('livewire.users');
    }
}
