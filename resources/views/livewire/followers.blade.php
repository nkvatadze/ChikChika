<div class="grid grid-cols-2 mt-5">

    <div class="col-span-1 ml-10 bg-white border-b border-gray-200 pb-5">
        <x-follow-user-navigation :user="$user" :currentUrl="$currentUrl"/>

        <div>
            @forelse($user->followers as $follower)
                <div
                    class="w-full border-b border-gray-200 flex justify-between items-center my-2 hover:bg-gray-100 rounded cursor-pointer px-5 py-2">
                    <a href="{{ route('users.show', ['user'=>$follower['username']]) }}" class="w-full">

                        <div class="flex justify-start items-start ">
                            <x-avatar class="w-10 h-10 mr-5" :src="$follower['profile_image_url']"/>
                            <div class="flex flex-col">
                                <p class="font-bold hover:underline text-lg">{{ $follower['name'] }}</p>
                                <p class="text-gray-500"><span>@</span>{{ $follower['username'] }}</p>
                                <p class="max-w-lg">{{ $follower->bio }}</p>
                            </div>
                        </div>
                    </a>
                    <div>
                        @if($follower->followedByAuth->isNotEmpty())
                            <button wire:click="$emitTo('users-to-follow', 'unfollow', {{ $follower['id'] }})"
                                    onmouseover="changeText(this, 'Unfollow')"
                                    onmouseout="changeText(this, 'Following')"
                                    class="bg-white text-black border border-gray-600 hover:bg-heart-hover hover:text-red-700
                                     transition ease-in px-3 py-1 rounded-full w-24">
                                {{ __('Following') }}
                            </button>
                        @else
                            <button wire:click="$emitTo('users-to-follow', 'follow', {{ $follower['id'] }})"
                                    class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
                                {{ __('Follow') }}
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-4 mt-20">
                    <div class="flex justify-center items-center col-span-4">
                        <img class="w-1/2" src="{{ asset('images/no-followers.png') }}"/>
                    </div>

                    <div class="col-start-2 col-end-5">
                        <h2 class="w-3/4 font-bold text-black text-3xl"> {{ __('Looking for followers?') }}</h2>
                        <h4 class="w-3/4 mt-2 font-bold text-gray-500">{{ __("When someone follows this account, they’ll show up here. Tweeting and interacting with others helps boost followers.") }}</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-span-1">
        <div>
            <input type="text" name="search" id="search">
        </div>
        <livewire:users-to-follow/>
    </div>
</div>
