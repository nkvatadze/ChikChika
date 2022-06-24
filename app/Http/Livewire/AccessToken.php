<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class AccessToken extends Component
{
    public string $token;

    public function generate()
    {
        $token = auth()->user()->createToken('api');

        $this->token = $token->plainTextToken;
    }

    public function render(): View
    {
        return view('livewire.access-token');
    }
}
