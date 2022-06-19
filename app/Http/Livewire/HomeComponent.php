<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\User;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render(): View
    {
        return view('livewire.home-component');
    }
}
