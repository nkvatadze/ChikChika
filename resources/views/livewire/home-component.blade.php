<div class="grid grid-cols-2">
    <div class="py-4 col-span-1">
        <div class="max-w-3xl ml-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="createTweet">
                        @csrf
                        <div class="flex justify-start items-start">
                            <div>
                                <x-avatar class="w-20 h-20 mr-5" :src="auth()->user()->profile_image_url"/>
                            </div>
                            <div class="w-full">
                                <label class="hidden" for="tweet"></label>
                                <textarea
                                    wire:model.lazy="tweet"
                                    class="w-full box-border resize-none text-xl py-5 border-transparent focus:border-transparent focus:ring-0 focus:outline-none overflow-visible"
                                    placeholder="What's happening?" name="tweet" id="tweet"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="bg-cyan-500 items-center text-lg text-white text-ellipsis whitespace-nowrap py-2 px-5 rounded-full hover:bg-cyan-600
                                cursor-pointer transition duration-300 ease-in-out">{{ __('Chik') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @forelse($tweets as $tweet)
            <div class="ml-10 p-6 flex justify-start items-start bg-white border-b border-gray-200">
                <div>
                    <x-avatar class="w-20 h-20 mr-5" :src="$tweet->user->profile_image_url"/>
                </div>
                <div class="flex flex-col max-w-lg">
                    <div class="flex justify-start items-start">
                        <p class="font-bold mr-3">{{ $tweet->user->name }}</p>
                        <p class="flex justify-start items-center text-gray-500">
                            <span>@</span>
                            {{ $tweet->user->username }}
                            <span class="mx-2 block w-1 h-1 rounded-full bg-gray-500"></span>
                        </p>
                        <p>{{ $tweet->created_at->toFormattedDateString() }}</p>
                    </div>
                    <div class="text-lg text-black">
                        <p class="tweets-list">
                            {{ $tweet->tweet }}
                        </p>
                    </div>
                    <div class="flex justify-start items-start mt-10">
                        <div class="flex justify-start items-center cursor-pointer mr-16 group ">
                            <div class="group-hover:bg-replies p-2 rounded-full transition ease-in">
                                <x-icon class="w-5 h-5" :src="asset('images/topic.png')"/>
                            </div>
                            @if($tweet->replies_count)
                                <span class="text-sm ml-2 mt-1">{{ $tweet->replies_count }}</span>
                            @endif
                        </div>
                        <div class="flex justify-start items-center cursor-pointer group"
                             @if($tweet->likedByAuthUser()) wire:click="dislike({{ $tweet->id }})"
                             @else wire:click="like({{ $tweet->id }})"
                            @endif>
                            <div class="group-hover:bg-heart-hover p-2 rounded-full transition ease-in">
                                @if($tweet->likedByAuthUser())
                                    <x-icon class="w-5 h-5" :src="asset('images/heart-filled.svg')"/>
                                @else
                                    <x-icon class="w-5 h-5" :src="asset('images/heart.svg')"/>
                                @endif
                            </div>
                            @if($tweet->likes_count)
                                <span
                                    class="text-sm ml-2 mt-1 group-hover:text-heart-main">{{ $tweet->likes_count }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="ml-10 p-6 flex flex-col justify-center items-center bg-white border-b border-gray-200">
                <x-icon class="w-6 h-6 my-5" :src="asset('images/sad.png')"/>
                <p>{{ __('No tweets to show yet') }}</p>
            </div>
        @endforelse

        @if($hasNextPage)
            <div class="flex justify-center  items-center mt-5">
                <button wire:click="loadTweets"
                        class="bg-cyan-500 text-white hover:opacity-90 transition ease-in rounded-full px-3 py-2">
                    {{ __('Load More') }}
                </button>
            </div>
        @endif
    </div>
    <div class="py-4 col-span-1">
        <div class="w-3/4 ml-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-2xl text-center text-gray-500">{{ __('Who to follow') }}</h1>

                <div class="flex flex-col justify-center items-start p-5">
                    @forelse($users as $user)
                        <div class="w-full flex justify-between items-center my-2">
                            <div class="flex justify-start items-start">
                                @include('partials.flash-messages')

                                <x-avatar class="w-10 h-10 mr-5" :src="$user->profile_image_url"/>
                                <div class="flex flex-col">
                                    <p class="font-bold">{{ $user->name }}</p>
                                    <p><span>@</span>{{ $user->username }}</p>
                                </div>
                            </div>
                            <div>
                                <button wire:click="follow({{ $user->id }})"
                                        class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
                                    {{ __('Follow') }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full flex flex-col justify-center items-center">
                            <x-icon class="w-6 h-6 my-5" :src="asset('images/sad.png')"/>
                            <p>{{ __('No users to show yet') }}</p>
                        </div>

                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        const tweetText = document.getElementById('tweet')

        tweetText.style.height = tweetText.scrollHeight + 'px';


        const replaceUrlsToLinks = () => {
            const tweets = document.getElementsByClassName('tweets-list');

            for (let i = 0; i < tweets.length; i++) {
                const tweet = tweets.item(i);
                tweet.innerHTML = tweet.innerHTML.trim().replace(
                    /(\b(https?|ftp|file):\/\/[\-A-Z0-9+&@#\/%?=~_|!:,.;]*[\-A-Z09+&@#\/%=~_| ])/img,
                    '<a target="_blank" class="text-cyan-500 hover:underline " href="$1">$1</a>'
                );
            }
        }

        Livewire.on('replace-tweet-urls-to-links', () => replaceUrlsToLinks())

        window.onload = () => replaceUrlsToLinks();
    </script>
@endpush
