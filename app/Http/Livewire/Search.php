<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';


    public function render()
    {
        $users = new Collection();

        if ($this->search) {
            $users = User::where('name', 'like', "%$this->search%")
                ->orWhere('email', 'like', "%$this->search%")
                ->orWhere('username', 'like', "%$this->search%")
                ->paginate(50);
        }

        return view('livewire.search', [
            'users' => $users
        ]);
    }
}
