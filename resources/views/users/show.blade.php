<x-app-layout>
    <div class="grid grid-cols-2 mt-5">
        <div class="col-span-1">
            <div class="ml-10 mb-4 p-6 flex flex-col justify-start items-start bg-white border-b border-gray-200">
                <x-avatar class="w-20 h-20 mr-5 ml-5" :src="$user->profile_image_url"/>
                <hr>
                <div class="px-4 mt-5">
                    <p class="font-bold text-lg">{{ $user->name }}</p>
                    <p class="text-md text-gray-500">{{ $user->username }}</p>
                    <div class="flex justify-start items-center">
                        <span><img src="{{ asset('images/calendar.png') }}"/></span>
                        <span>{{ __('Joined') }} {{ $user->created_at->format('F Y') }}</span>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="hover:underline mr-5">
                            <span class="font-bold">{{ $user->followings_count }}</span>
                            <span class="text-gray-500">{{ __('Followings') }}</span>
                        </a>
                        <a href="#" class="hover:underline">
                            <span class="font-bold">{{ $user->followers_count }}</span>
                            <span class="text-gray-500">{{ __('Followers') }}</span>
                        </a>
                    </div>
                    @if(!auth()->user()->hasBeenFollowing($user))
                        <div>
                            <button wire:click="follow({{ $user->id }})"
                                    class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
                                {{ __('Follow') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            @if(!$isRestricted)
                <livewire:tweets :tweetsByUserId="$user->id"/>
            @else
                <div class="grid grid-cols-3 mt-20">
                    <div class="col-start-2 col-end-4">
                        <h2 class="w-1/2 font-bold text-black text-3xl"> {{ __('These Tweets are protected') }}</h2>
                        <h4 class="w-3/5 mt-2 font-bold text-gray-500">{{ __("Only approved followers can see $user->username's Tweets. To request access, click Follow") }}</h4>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-span-1">
            <livewire:users-to-follow/>
        </div>
    </div>
</x-app-layout>
