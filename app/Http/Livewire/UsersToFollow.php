<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class UsersToFollow extends Component
{
    public EloquentCollection $users;

    protected $listeners = ['follow', 'unfollow'];

    public function mount()
    {
        $this->users = new EloquentCollection();

        $this->users->push(
            ...User::notAuth()->notFollowedBy(auth()->id())->paginate(15)->items()
        );
    }

    public function follow(User $user): void
    {
        auth()->user()->followings()->attach($user);

        $this->emitUp('followToggle', $user);

        session()->flash('success', "User $user->username followed successfully");
    }

    public function unfollow(User $user): void
    {
        auth()->user()->followings()->detach($user);

        $this->emitUp('followToggle', $user);

        session()->flash('success', "User $user->username unfollowed successfully");
    }

    public function render()
    {
        $this->users->load('followedByAuth');

        return view('livewire.users-to-follow');
    }
}
