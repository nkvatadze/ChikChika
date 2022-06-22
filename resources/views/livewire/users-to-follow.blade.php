<div class="w-3/4 ml-10 sticky top-28 self-start">
    <div class="sticky-top  bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="text-2xl text-center text-gray-500">{{ __('Who to follow') }}</h1>

        <div class="flex flex-col justify-center items-start">
            @include('partials.flash-messages')

            @forelse($users as $user)
                <div
                    class="w-full flex justify-between items-center my-2 hover:bg-gray-100 rounded cursor-pointer px-5 py-2">
                    <a href="{{ route('users.show', ['user'=>$user['username']]) }}" class="w-full">

                        <div class="flex justify-start items-start ">
                            <x-avatar class="w-10 h-10 mr-5" :src="$user['profile_image_url']"/>
                            <div class="flex flex-col">
                                <p class="font-bold hover:underline">{{ $user['name'] }}</p>
                                <p><span>@</span>{{ $user['username'] }}</p>
                            </div>
                        </div>
                    </a>

                    <div>
                        @if($user->followedByAuth->isNotEmpty())
                            <button wire:click="unfollow({{ $user['id'] }})"
                                    onmouseover="changeText(this, 'Unfollow')"
                                    onmouseout="changeText(this, 'Following')"
                                    class="bg-white text-black border border-gray-600 hover:bg-heart-hover hover:text-red-700
                                     transition ease-in px-3 py-1 rounded-full w-24">
                                {{ __('Following') }}
                            </button>
                        @else
                            <button wire:click="follow({{ $user['id'] }})"
                                    class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
                                {{ __('Follow') }}
                            </button>
                        @endif
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

@push('scripts')
    <script>
        const changeText = (e, text) => e.innerHTML = text;
    </script>
@endpush
