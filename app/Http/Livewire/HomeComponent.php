<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\{Tweet, User};
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class HomeComponent extends Component
{
    public EloquentCollection $tweets;

    public function mount()
    {
        $this->tweets = Tweet::all();
    }

    public function follow(int $userId)
    {
        auth()->user()->followings()->attach($userId);
    }

    public function render(): View
    {
        $users = User::notAuth()->notFollowedBy(auth()->id())->get();

        return view('livewire.home-component', [
            'users' => $users
        ]);
    }
}
