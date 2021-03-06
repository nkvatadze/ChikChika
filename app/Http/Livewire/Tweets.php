<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;

class Tweets extends Component
{
    const PER_PAGE = 5;

    public ?int $tweetsByUserId = null;
    public int $page = 1;
    public bool $hasNextPage;
    public EloquentCollection $tweets;

    protected $listeners = ['createTweet'];

    public function mount(?int $tweetsByUserId = null): void
    {
        $this->tweetsByUserId = $tweetsByUserId;

        $this->tweets = new EloquentCollection();

        $this->loadTweets();
    }

    public function loadTweets(): void
    {
        $tweets = (new Tweet)->tweetsForFeed($this->page, $this->tweetsByUserId);

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

    public function createTweet(string $tweet): void
    {
        $tweet = auth()->user()->tweets()->create([
            'content' => $tweet
        ]);

        $this->tweets->prepend($tweet);
    }

    public function like($tweetId): void
    {
        $like = auth()->user()->likeTweet($tweetId);

        $tweet = $this->tweets->find($tweetId);

        $tweet->likes->push($like);

        $tweet->likes_count++;
    }

    public function unlike($tweetId): void
    {
        auth()->user()->unlikeTweet($tweetId);

        $tweet = $this->tweets->find($tweetId);

        $tweet->likes->pop();

        $tweet->likes_count--;
    }

    public function redirectToTweet(int $tweetId)
    {
        redirect()->route('tweets.show', ['tweet' => $tweetId]);
    }

    public function render()
    {
        $this->emit('replace-tweet-urls-to-links');

        return view('livewire.tweets');
    }
}
