<div class="grid grid-cols-2">
    <div class="py-4 col-span-1">
        <div class="max-w-2xl ml-10">
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
                                    wire:model="tweet.tweet"
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
            <div class="ml-10 p-6 flex flex-col justify-center items-center bg-white border-b border-gray-200">
                <div class="flex justify-start items-start">
                    <p class="font-bold">{{ $tweet->user->name }}</p>
                    <p><span>@</span>{{ $tweet->user->username }}</p>
                </div>
            </div>
        @empty
            <div class="ml-10 p-6 flex flex-col justify-center items-center bg-white border-b border-gray-200">
                <x-sad-emoji class="w-6 h-6 my-5"/>
                <p>{{ __('No tweets to show yet') }}</p>
            </div>
        @endforelse
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
                                        class="bg-black px-3 py-1 rounded-full text-white">
                                    {{ __('Follow') }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full flex flex-col justify-center items-center">
                            <x-sad-emoji class="w-6 h-6 my-5"/>
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
    </script>
@endpush
