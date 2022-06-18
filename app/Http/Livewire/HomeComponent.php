<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\View\View;
use App\Models\{Tweet, User};
use Livewire\Component;

class HomeComponent extends Component
{
    const PER_PAGE = 5;

    public string $tweet;
    public int $page = 1;
    public bool $hasNextPage;
    public EloquentCollection $tweets;

    protected $rules = [
        'tweet' => 'required|string|min:1|max:140'
    ];

    public function mount(): void
    {
        $this->tweet = '';

        $this->tweets = new EloquentCollection();

        $this->loadTweets();
    }

    public function loadTweets(): void
    {
        $tweets = Tweet::query()->withCount('likes', 'replies')
            ->orderByDesc('id')
            ->with([
                'user',
                'likes' => fn($query) => $query->where('user_id', auth()->id())
            ])->paginate(self::PER_PAGE, page: $this->page);

        $this->tweets->push(...$tweets->items());

        $this->page++;

        $this->hasNextPage = $tweets->hasMorePages();
    }

    public function hydrateTweets(): void
    {
        $this->tweets
            ->loadCount(['likes', 'replies'])
            ->load([
                'user',
                'likes' => fn($query) => $query->where('user_id', auth()->id())
            ]);
    }

    public function follow(User $user): void
    {
        auth()->user()->followings()->attach($user);

        session()->flash('success', "User $user->username followed successfully");
    }

    public function createTweet(): void
    {
        $this->validate();

        $tweet = auth()->user()->tweets()->create([
            'tweet' => $this->tweet
        ]);

        $this->tweets->prepend($tweet);

        $this->tweet = '';
    }

    public function like($tweetId): void
    {
        $like = auth()->user()->likedTweets()->create([
            'tweet_id' => $tweetId
        ]);

        $tweet = $this->tweets->find($tweetId);

        $tweet->likes->push($like);

        $tweet->likes_count++;
    }

    public function dislike($tweetId): void
    {
        auth()->user()->likedTweets()->where('tweet_id', $tweetId)->delete();

        $tweet = $this->tweets->find($tweetId);

        $tweet->likes->pop();

        $tweet->likes_count--;
    }


    public function render(): View
    {
        return view('livewire.home-component', [
            'users' => User::notAuth()->notFollowedBy(auth()->id())->paginate(15),
        ]);
    }
}
