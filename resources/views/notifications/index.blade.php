<x-app-layout>

    <x-slot:header>
        <p class="text-black text-xl">{{ __('Notifications') }}</p>
    </x-slot:header>

    <div class="grid grid-cols-2 items-start mt-5">
        <div class="col-span-1 ml-10 bg-white border-b border-gray-200">
            @forelse($notifications as $notification)


                @switch($notification->type)

                    @case(App\Enums\NotificationTypes::FollowedUserTweeted->value)
                    <x-notifications.followed-user-tweeted
                        :data="$notification->data"></x-notifications.followed-user-tweeted>
                    @break

                    @case(App\Enums\NotificationTypes::FollowedByUser->value)
                    <x-notifications.followed-by-user
                        :data="$notification->data"></x-notifications.followed-by-user>
                    @break

                    @case(App\Enums\NotificationTypes::UnfollowedByUser->value)
                    <x-notifications.unfollowed-by-user
                        :data="$notification->data"></x-notifications.unfollowed-by-user>
                    @break

                    @case(App\Enums\NotificationTypes::UserLikedTweet->value)
                    <x-notifications.user-liked-tweet
                        :data="$notification->data"></x-notifications.user-liked-tweet>
                    @break

                    @case(App\Enums\NotificationTypes::UserRepliedToTweet->value)
                    <x-notifications.user-replied-to-tweet
                        :data="$notification->data"></x-notifications.user-replied-to-tweet>
                    @break

                @endswitch
            @empty
                <div class="grid grid-cols-3 mt-20 pb-10">
                    <div class="col-start-2 col-end-4">
                        <h2 class="w-3/4 font-bold text-black text-4xl"> {{ __('Nothing to see here — yet') }}</h2>
                        <h4 class="w-3/5 mt-2 font-bold text-gray-500">{{ __("From likes to Retweets and a whole lot more, this is where all the action happens.") }}</h4>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="col-span-1 sticky top-0 self-start">
            <livewire:users-to-follow/>
        </div>
    </div>


</x-app-layout>
