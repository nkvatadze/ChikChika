<x-slot:header>
    <p class="text-black text-xl">{{ __('Home') }}</p>
</x-slot:header>

<div class="grid grid-cols-2">
    <div class="py-4 col-span-1">
        <div class="max-w-3xl ml-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form wire:submit.prevent="createTweet">
                        @csrf
                        <div class="flex justify-start items-start">
                            <div>
                                <a href="{{ route('users.show', ['user'=>auth()->user()->username]) }}">
                                    <x-avatar class="w-20 h-20 mr-5" :src="auth()->user()->profile_image_url"/>
                                </a>
                            </div>
                            <div class="w-full">
                                <label class="hidden" for="content"></label>
                                <textarea
                                    wire:model.lazy="content"
                                    class="w-full box-border resize-none text-xl py-5 border-transparent focus:border-transparent focus:ring-0 focus:outline-none overflow-visible"
                                    placeholder="{{ __('What\'s happening?' ) }}" name="content" id="content"></textarea>
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
        <livewire:tweets/>
    </div>
    <div class="py-4 col-span-1">
        <livewire:users-to-follow/>
    </div>

</div>

@push('scripts')
    <script>
        const tweetText = document.getElementById('tweet')

        tweetText.style.height = tweetText.scrollHeight + 'px';
    </script>
@endpush
