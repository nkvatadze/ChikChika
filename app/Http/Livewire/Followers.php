<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;

class Followers extends FollowBaseClass
{
    public function render(): View
    {
        $this->user->load('followers', 'followers.followedByAuth');

        return view('livewire.followers');
    }
}
