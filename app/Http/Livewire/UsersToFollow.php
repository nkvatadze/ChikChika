<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersToFollow extends Component
{
    public function follow(User $user): void
    {
        auth()->user()->followings()->attach($user);

        session()->flash('success', "User $user->username followed successfully");
    }

    public function render()
    {
        return view('livewire.users-to-follow', [
            'users' => User::notAuth()->notFollowedBy(auth()->id())->paginate(15),
        ]);
    }
}
