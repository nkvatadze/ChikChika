<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class Followings extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render(): View
    {
        $this->user->load('followings');

        return view('livewire.followings');
    }
}
