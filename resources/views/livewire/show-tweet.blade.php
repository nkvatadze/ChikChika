<x-slot:header>
    <p class="font-bold text-lg">{{ __('Tweet') }}</p>
</x-slot:header>

<div class="grid grid-cols-2 mt-5">
    <div class="col-span-1">
        <div class="ml-10 px-8 pb-6 bg-white border-b border-gray-200 rounded-t-md">
            <div class="py-6 flex justify-start items-start ">
                <a href="{{ route('users.show', ['user'=>$tweet->user->username]) }}">
                    <x-avatar class="w-20 h-20 mr-5" :src="$tweet->user->profile_image_url"/>
                </a>
                <div class="px-4">
                    <p class="font-bold text-lg">{{ $tweet->user->name }}</p>
                    <p class="text-md text-gray-500"><span>@</span>{{ $tweet->user->username }}</p>
                </div>
            </div>
            <div class="pb-8">
                <p class="text-3xl text-black">{{ $tweet->tweet }}</p>
            </div>
            <div class=" flex justify-start items-center">
                <span>{{ $tweet->created_at->format('g:i A') }}</span>
                <span class="mx-2 dot"></span>
                <span>{{ $tweet->created_at->toFormattedDateString() }} </span>
            </div>
            <div class="w-full">
                <div class="mt-2 w-full bg-gray-200 h-px">
                </div>
            </div>
            <div class="flex justify-start items-center py-2">
                <p class="mr-24"><span class="mr-2">{{ $tweet->replies_count }}</span><span>{{ __('Replies') }}</span>
                </p>
                <p><span class="mr-2">{{ $tweet->likes_count }}</span><span>{{ __('Likes') }}</span></p>
            </div>
            <div class="w-full">
                <div class="mt-2 w-full bg-gray-200 h-px">
                </div>
            </div>
            <div @auth @if($tweet->liked_by_auth_user) wire:click="unlike" @else wire:click="like" @endif @endauth
            class="cursor-pointer group mt-3">
                @auth
                    @if($tweet->liked_by_auth_user)
                        <i class="fa-solid fa-heart group-hover:bg-heart-hover group-hover:text-heart-main p-2
                            rounded-full transition ease-in text-heart-main text-xl"></i>
                    @else
                        <i class="fa-regular fa-heart group-hover:bg-heart-hover group-hover:text-heart-main p-2
                            rounded-full transition ease-in text-gray-500 text-xl"></i>
                    @endif
                @endauth

                @guest
                    <a href="{{ route('login') }}">
                        <i class="fa-regular fa-heart group-hover:bg-heart-hover group-hover:text-heart-main p-2
                            rounded-full transition ease-in text-gray-500 text-xl"></i>
                    </a>
                @endguest
            </div>
            <div class="w-full">
                <div class="mt-2 w-full bg-gray-200 h-px">
                </div>
            </div>
            @auth
                <div class="mt-5">
                    <form wire:submit.prevent="reply">
                        @csrf
                        <div class="flex justify-start items-start">
                            <div class="mt-2">
                                <a href="{{ route('users.show', ['user'=>auth()->user()->username]) }}">
                                    <x-avatar class="w-16 h-16 mr-5" :src="auth()->user()->profile_image_url"/>
                                </a>
                            </div>
                            <div class="w-full">
                                <label class="hidden" for="content"></label>
                                <textarea
                                    wire:model.lazy="content"
                                    class="w-full box-border resize-none text-xl py-5 border-transparent focus:border-transparent focus:ring-0 focus:outline-none overflow-visible"
                                    placeholder="{{ __('Chik your reply') }}" name="content" id="content"></textarea>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="bg-cyan-500 items-center text-lg text-white text-ellipsis whitespace-nowrap py-2 px-5 rounded-full hover:bg-cyan-600
                                cursor-pointer transition duration-300 ease-in-out">{{ __('Chik') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
        @foreach($tweet->replies as $reply)
            <div
                class="ml-10 hover:bg-gray-50 cursor-pointer p-6 flex justify-start items-start bg-white {{ $loop->last ? 'rounded-b-md' :'' }} border-b border-gray-300">

                <div>
                    {{-- Wrap anchord tag in object tag in order to have nested links --}}
                    <object>
                        <a href="{{ route('users.show', ['user' => $reply->user->username]) }}">
                            <x-avatar class="w-20 h-20 mr-5" :src="$reply->user->profile_image_url"/>
                        </a>
                    </object>
                </div>
                <div class="flex flex-col max-w-lg">
                    <div class="flex justify-start items-start">
                        <p class="font-bold mr-3">{{ $reply->user->name }}</p>
                        <p class="flex justify-start items-center text-gray-500">
                            <span>@</span>
                            {{ $reply->user->username }}
                            <span class="mx-2 dot"></span>
                        </p>
                        <p>{{ $reply->created_at->toFormattedDateString() }}</p>
                    </div>
                    <div>
                        <p><span>{{ __('Replying to') }}</span> <a
                                href="{{ route('users.show', ['user'=>$tweet->user->username]) }}"
                                class="text-cyan-500 hover:underline">@<span>{{ $tweet->user->username }}</span></a></p>
                    </div>
                    <div class="text-lg text-black">
                        <p class="tweets-list">
                            {{ $reply->content }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    @auth
        <div class="col-span-1">
            <livewire:users-to-follow/>
        </div>
    @endauth
</div>
