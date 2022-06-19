<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public string $tweet = '';

    protected $rules = [
        'tweet' => 'required|string|min:1|max:140'
    ];

    public function createTweet()
    {
        $this->validate();

        $this->emitTo('tweets', 'createTweet', $this->tweet);

        $this->tweet = '';
    }

    public function render(): View
    {
        return view('livewire.home');
    }
}
