@if($tweet && $tweet->user)
    <a href="{{ route('tweets.show', ['tweet' => $tweet->getKey()]) }}">
        <div
            class="w-full border-b border-gray-200 flex justify-start items-start hover:bg-gray-50 rounded cursor-pointer pl-10 pr-6 pb-4 pt-10">
            <i class="text-fuchsia-700 text-3xl fa-solid fa-feather-pointed"></i>
            <div class="ml-5 flex flex-col">
                <x-avatar class="w-10 h-10 mr-5" :src="$tweet->user->profile_image_url"/>
                <div class="mt-5">
                    <p><span class="font-bold">{{ $tweet->user->name }}</span> {{ __('chicked') }}</p>
                    <p class="text-gray-500">{{ $tweet->content }}</p>
                </div>
            </div>
        </div>
    </a>
@endif
