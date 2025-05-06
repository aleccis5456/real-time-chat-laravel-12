<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    public object $users;

    public function mount() : void {
        $this->users = User::where('id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.users');
    }
    
}
