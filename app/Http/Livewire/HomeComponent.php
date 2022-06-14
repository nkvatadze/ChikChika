<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use App\Models\{Tweet, TweetLike, User};
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

    public function like($tweetId)
    {
        auth()->user()->likedTweets()->create([
            'tweet_id' => $tweetId
        ]);
    }

    public function dislike($tweetId)
    {
        auth()->user()->likedTweets()->where('tweet_id', $tweetId)->delete();
    }

    public function render(): View
    {
        $users = User::notAuth()->notFollowedBy(auth()->id())->get();

        return view('livewire.home-component', [
            'users' => $users,
            'tweets' => Tweet::withCount('likes', 'replies')
                ->with([
                    'likes' => fn($query) => $query->where('user_id', auth()->id())
                ])
                ->get()
        ]);
    }
}
