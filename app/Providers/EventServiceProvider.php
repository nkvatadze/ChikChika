<?php

namespace App\Providers;

use App\Models\FollowerUser;
use App\Models\Tweet;
use App\Models\TweetLike;
use App\Models\TweetReply;
use App\Models\User;
use App\Observers\FollowerUserObserver;
use App\Observers\TweetLikeObserver;
use App\Observers\TweetObserver;
use App\Observers\TweetReplyObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        FollowerUser::observe(FollowerUserObserver::class);
        Tweet::observe(TweetObserver::class);
        TweetLike::observe(TweetLikeObserver::class);
        TweetReply::observe(TweetReplyObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
