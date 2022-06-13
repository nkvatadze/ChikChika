<x-app-layout>
    <div class="grid grid-cols-2">
        <div class="py-4 col-span-1">
            <div class="max-w-2xl ml-10">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="#">
                            <div class="flex justify-start items-start">
                                <div>
                                    <x-avatar class="w-20 h-20 mr-5"/>
                                </div>
                                <div class="w-full">
                                    <label class="hidden" for="tweet"></label>
                                    <textarea
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
                <div>
                </div>
            @empty
                <div class="ml-10 p-6 flex flex-col justify-center items-center bg-white border-b border-gray-200">
                    <x-sad-emoji class="w-6 h-6 my-5"/>
                    <p>{{ __('No tweets to show yet') }}</p>
                </div>
            @endforelse
        </div>
        <div class="py-4 col-span-1">
            <div class="w-1/2 ml-10">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col justify-center items-center ">
                        <h1 class="text-2xl text-gray-500">{{ __('Who to follow') }}</h1>
                        @forelse($users as $user)

                        @empty
                            <x-sad-emoji class="w-6 h-6 my-5"/>
                            <p>{{ __('No users to show yet') }}</p>
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
</x-app-layout>
