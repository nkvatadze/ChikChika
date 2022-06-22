<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use App\Models\TweetReply;
use Illuminate\View\View;
use Livewire\Component;

class ShowTweet extends Component
{
    public Tweet $tweet;
    public string $content;

    protected $rules = [
        'reply' => 'required|string|min:1|max:140'
    ];

    public function mount(Tweet $tweet)
    {
        $this->tweet = $tweet;
        $this->content = '';
        $this->tweet->load('user');
    }

    public function like(): void
    {
        $like = auth()->user()->likedTweets()->create([
            'tweet_id' => $this->tweet->id
        ]);

        $this->tweet->likes->push($like);

        $this->tweet->likes_count++;
    }

    public function dislike(): void
    {
        auth()->user()->likedTweets()->where('tweet_id', $this->tweet->id)->delete();

        $this->tweet->likes->pop();

        $this->tweet->likes_count--;
    }

    public function reply()
    {
        $reply = $this->tweet->replies()->create([
            'user_id' => auth()->id(),
            'content' => $this->content
        ]);

        $this->tweet->replies->prepend($reply);

        $this->tweet->replies_count++;

        $this->content = '';
    }

    public function render(): View
    {
        $this->tweet->loadCount('replies', 'likes')->load([
            'replies' => fn($query) => $query->orderBy('id', 'DESC'),
            'replies.user',
            'likes' => fn($query) => $query->where('user_id', auth()->id())
        ]);

        return view('livewire.show-tweet');
    }
}
