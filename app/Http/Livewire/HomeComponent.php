<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\{Tweet, User};
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class HomeComponent extends Component
{
    public EloquentCollection $users;
    public EloquentCollection $tweets;

    public function mount()
    {
        $this->users = User::notAuth()->get();
        $this->tweets = Tweet::all();
    }

    public function render(): View
    {
        return view('livewire.home-component');
    }
}
