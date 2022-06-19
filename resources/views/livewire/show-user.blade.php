<div class="grid grid-cols-2 mt-5">
    <div class="col-span-1">
        <div class="ml-10 bg-white border-b border-gray-200 flex justify-between items-center">
            <div class="mb-4 p-6 flex flex-col justify-start items-start ">
                <x-avatar class="w-20 h-20 mr-5" :src="$user->profile_image_url"/>
                <hr>
                <div class="px-4 mt-5">
                    <p class="font-bold text-lg">{{ $user->name }}</p>
                    <p class="text-md text-gray-500">{{ $user->username }}</p>
                    <div class="flex justify-start items-center mt-2 mr-5 inline">
                        <span><i class="fa-solid fa-calendar-days text-gray-600 mr-2 text-lg"></i></span>
                        <span class="text-gray-500">{{ __('Joined') }} {{ $user->created_at->format('F Y') }}</span>
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
                </div>
            </div>

            @if(!auth()->user()->hasBeenFollowing($user))
                <div class="mr-5">
                    <button wire:click="follow({{ $user->id }})"
                            class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white text-lg">
                        {{ __('Follow') }}
                    </button>
                </div>
            @endif
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
