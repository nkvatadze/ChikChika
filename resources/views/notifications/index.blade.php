<x-app-layout>

    <x-slot:header>
        <p class="text-black text-xl">{{ __('Notifications') }}</p>
    </x-slot:header>

    <div class="grid grid-cols-2 items-start mt-5">
        <div class="col-span-1 ml-10 bg-white border-b border-gray-200">
            @forelse($notifications as $notification)


                @switch($notification->type)

                    @case(App\Enums\NotificationTypes::FollowedByUser->value)
                    <x-notifications.followed-by-user
                        :data="$notification->data" class=""></x-notifications.followed-by-user>
                    @break

                    @case(App\Enums\NotificationTypes::UnfollowedByUser->value)
                    <x-notifications.unfollowed-by-user
                        :data="$notification->data"></x-notifications.unfollowed-by-user>
                    @break

                @endswitch

                <div class="flex justify-start items-start ">
                    {{--                                <x-avatar class="w-10 h-10 mr-5" :src="$following['profile_image_url']"/>--}}
                    <div class="flex flex-col">
                        {{--                                    <p class="font-bold hover:underline text-lg">{{ $following['name'] }}</p>--}}
                        {{--                                    <p class="text-gray-500"><span>@</span>{{ $following['username'] }}</p>--}}
                        {{--                                    <p class="max-w-lg">{{ $following->bio }}</p>--}}
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-3 mt-20">
                    <div class="col-start-2 col-end-4">
                        <h2 class="w-3/4 font-bold text-black text-4xl"> {{ __('Be in the know') }}</h2>
                        <h4 class="w-3/5 mt-2 font-bold text-gray-500">{{ __("Following accounts is an easy way to curate your timeline and know what’s happening with the topics and people you’re interested in.") }}</h4>
                        <div class="mt-5">
                            <a href="#"
                               class="text-2xl text-white bg-cyan-500 hover:bg-cyan-600 rounded-full py-2 px-5">{{ __('Find people to follow') }}</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="col-span-1 sticky top-0 self-start">
            <livewire:users-to-follow/>
        </div>
    </div>


</x-app-layout>
