<div class="grid grid-cols-2 mt-5">

    <div class="col-span-1 ml-10 bg-white border-b border-gray-200">
        <x-follow-user-navigation :user="$user" :currentUrl="$currentUrl"/>

        <div class="h-screen">
            @forelse($user->followings as $following)
                <div
                    class="w-full border-b border-gray-200 flex justify-between items-center my-2 hover:bg-gray-100 rounded cursor-pointer px-5 py-2">
                    <a href="{{ route('users.show', ['user'=>$following['username']]) }}" class="w-full">

                        <div class="flex justify-start items-start ">
                            <x-avatar class="w-10 h-10 mr-5" :src="$following['profile_image_url']"/>
                            <div class="flex flex-col">
                                <p class="font-bold hover:underline text-lg">{{ $following['name'] }}</p>
                                <p class="text-gray-500"><span>@</span>{{ $following['username'] }}</p>
                                <p class="max-w-lg">{{ $following->bio }}</p>
                            </div>
                        </div>
                    </a>
                    <div>
                        @if($following->followedByAuth->isNotEmpty())
                            <button wire:click="$emitTo('users-to-follow', 'unfollow', {{ $following['id'] }})"
                                    onmouseover="changeText(this, 'Unfollow')"
                                    onmouseout="changeText(this, 'Following')"
                                    class="bg-white text-black border border-gray-600 hover:bg-heart-hover hover:text-red-700
                                     transition ease-in px-3 py-1 rounded-full w-24">
                                {{ __('Following') }}
                            </button>
                        @else
                            <button wire:click="$emitTo('users-to-follow', 'follow', {{ $following['id'] }})"
                                    class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
                                {{ __('Follow') }}
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-3 mt-20">
                    <div class="col-start-2 col-end-4">
                        <h2 class="w-3/4 font-bold text-black text-4xl"> {{ __('Be in the know') }}</h2>
                        <h4 class="w-3/5 mt-2 font-bold text-gray-500">{{ __("Following accounts is an easy way to curate your timeline and know what’s happening with the topics and people you’re interested in.") }}</h4>
                        <div class="mt-5">
                            <a href="#" class="text-2xl text-white bg-cyan-500 hover:bg-cyan-600 rounded-full py-2 px-5">{{ __('Find people to follow') }}</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-span-1">
        <livewire:users-to-follow/>
    </div>
</div>
