<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class ShowTweet extends Component
{
    use AuthorizesRequests;

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
        $like = auth()->user()->likeTweet($this->tweet->id);

        $this->tweet->likes->push($like);

        $this->tweet->likes_count++;
    }

    public function unlike(): void
    {
        auth()->user()->unlikeTweet($this->tweet->id);

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

    /**
     * @throws AuthorizationException
     */
    public function render(): View
    {
        $this->authorize('show', $this->tweet);

        $this->tweet->loadCount('replies', 'likes')->load([
            'replies' => fn($query) => $query->orderBy('id', 'DESC'),
            'replies.user',
            'likes' => fn($query) => $query->where('user_id', auth()->id())
        ]);

        return view('livewire.show-tweet');
    }
}
