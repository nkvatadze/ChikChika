@if($tweetReply && $tweetReply->user)
    <a href="{{ route('tweets.show', ['tweet' => $tweetReply->tweet->getKey()]) }}">
        <div
            class="w-full border-b border-gray-200 flex justify-start items-start hover:bg-gray-50 rounded cursor-pointer pl-10 pr-6 pb-4 pt-10">
            <i class="text-cyan-500 text-3xl fa-solid fa-reply"></i>
            <div class="ml-5 flex flex-col">
                <x-avatar class="w-10 h-10 mr-5" :src="$tweetReply->user->profile_image_url"/>
                <div class="mt-5">
                    <p><span class="font-bold">{{ $tweetReply->user->name }}</span> {{ __('replied to your tweet') }}
                    </p>
                    <p class="text-gray-500">{{ $tweetReply->content }}</p>
                </div>
            </div>
        </div>
    </a>
@endif
