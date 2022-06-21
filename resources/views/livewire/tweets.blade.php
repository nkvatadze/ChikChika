<div>
    @forelse($tweets as $tweet)
        <div
            class="ml-10 hover:bg-gray-50 cursor-pointer p-6 flex justify-start items-start bg-white {{ $loop->last ? 'rounded-b-md' :'' }} border-b border-gray-300">
            <div>
                <a href="{{ route('users.show', ['user'=>$tweet->user->username]) }}">
                    <x-avatar class="w-20 h-20 mr-5" :src="$tweet->user->profile_image_url"/>
                </a>
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
                         @if($tweet->liked_by_auth_user) wire:click="dislike({{ $tweet->id }})"
                         @else wire:click="like({{ $tweet->id }})"
                        @endif>
                        @if($tweet->liked_by_auth_user)
                            <i class="fa-solid fa-heart group-hover:bg-heart-hover group-hover:text-heart-main p-2
                            rounded-full transition ease-in text-heart-main text-xl">
                            </i>
                        @else
                            <i class="fa-regular fa-heart group-hover:bg-heart-hover group-hover:text-heart-main p-2
                            rounded-full transition ease-in text-gray-500 text-xl">
                            </i>
                        @endif
                        @if($tweet->likes_count)
                            <span
                                class="text-sm @if($tweet->liked_by_auth_user) text-heart-main @endif ml-2 mt-1 group-hover:text-heart-main">{{ $tweet->likes_count }}</span>
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
        <div class="flex justify-center items-center mt-5">
            <button wire:click="loadTweets"
                    class="bg-cyan-500 text-white hover:opacity-90 transition ease-in rounded-full px-3 py-2">
                {{ __('Load More') }}
            </button>
        </div>
    @endif
</div>

@push('scripts')
    <script>
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
