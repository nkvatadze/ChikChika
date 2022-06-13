<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\{Tweet, User};
use Livewire\Component;

class HomeComponent extends Component
{
    public Tweet $tweet;

    protected $rules = [
        'tweet.tweet' => 'required|string|min:1|max:140'
    ];

    public function mount()
    {
        $this->tweet = new Tweet();
    }

    public function follow(User $user)
    {
        auth()->user()->followings()->attach($user);

        session()->flash('success', "User $user->username followed successfully");
    }

    public function createTweet()
    {
        $this->validate();

        $this->tweet->user_id = auth()->id();

        $this->tweet->save();
    }

    public function render(): View
    {
        $users = User::notAuth()->notFollowedBy(auth()->id())->get();

        return view('livewire.home-component', [
            'users' => $users,
            'tweets' => Tweet::all()
        ]);
    }
}
