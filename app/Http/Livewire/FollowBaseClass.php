<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

abstract class FollowBaseClass extends Component
{
    public User $user;
    public string $currentUrl;

    protected $listeners = ['followToggle'];

    public function mount(User $user): void
    {
        $this->currentUrl = url()->current();
        $this->user = $user;
    }

    public function followToggle(User $user)
    {
        if ($this->user->is($user)) {
            $this->render();
        }
    }

    abstract public function render();
}
