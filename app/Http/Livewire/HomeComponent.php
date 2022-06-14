<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\View\View;
use App\Models\{Tweet, TweetLike, User};
use Livewire\Component;

class HomeComponent extends Component
{
    const PER_PAGE = 5;

    public Tweet $tweet;
    public int $lastTweetId;
    public bool $shouldLoadMore = false;
//    public EloquentCollection $tweets;

    protected $rules = [
        'tweet.tweet' => 'required|string|min:1|max:140'
    ];

    public function mount()
    {
        $this->tweet = new Tweet();

//        $this->tweets = Tweet::query()->withCount('likes', 'replies')
//            ->limit(self::PER_PAGE)
//            ->orderByDesc('id')
//            ->with([
//                'likes' => fn($query) => $query->where('user_id', auth()->id())
//            ])
//            ->get();

//        $this->lastTweetId = $this->tweets->last()->id;

//        $this->shouldLoadMore = (bool)Tweet::selectRaw('1')
//            ->where('id', '<', $this->lastTweetId)
//            ->first();
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

        $this->tweets->prepend($this->tweet);
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

    /**
     * @return void
     */
    public function loadMore(): void
    {
        $this->lastTweetId = $this->tweets->last()->id;
        $this->shouldLoadMore = (bool)Tweet::selectRaw('1')
            ->where('id', '<', $this->lastTweetId)
            ->first();
    }

    public function render(): View
    {
        $users = User::notAuth()->notFollowedBy(auth()->id())->get();


        return view('livewire.home-component', [
            'users' => $users,
            'tweets' => Tweet::query()->withCount('likes', 'replies')
                ->orderByDesc('id')
                ->with([
                    'likes' => fn($query) => $query->where('user_id', auth()->id())
                ])
                ->get()
        ]);
    }
}
