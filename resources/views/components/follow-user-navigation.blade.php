<div class="p-3">
    <span class="block font-bold text-lg">{{ $user->name }}</span>
    <span class="text-gray-500"><span>@</span>{{ $user->username }}</span>
</div>
<div class="grid grid-cols-2 mt-5 text-md text-gray-500 font-bold text-center border-b border-gray-200">
    <a class="{{ $currentUrl === route('users.followers', ['user'=>$user->username]) ? 'text-black font-bold' : '' }}"
       href="{{ route('users.followers', ['user'=>$user->username]) }}">
        <div class="relative col-span-1 cursor-pointer hover:bg-gray-50 p-5">
            <p>
                {{ __('Followers') }}
            </p>

            @if($currentUrl === route('users.followers', ['user'=>$user->username]))
                <div class="rounded-full absolute bottom-0 left-1/2 -translate-x-1/2 w-24 h-1.5 bg-blue-600">
                </div>
            @endif
        </div>
    </a>
    <a class="{{ $currentUrl === route('users.followings', ['user'=>$user->username]) ? 'text-black font-bold' : '' }}"
       href="{{ route('users.followings', ['user'=>$user->username]) }}">
        <div class="relative col-span-1 cursor-pointer hover:bg-gray-50 py-5">
            <p>
                {{ __('Followings') }}
            </p>
            @if($currentUrl === route('users.followings', ['user'=>$user->username]))
                <div class="rounded-full absolute bottom-0 left-1/2 -translate-x-1/2 w-24 h-1.5 bg-blue-600">
                </div>
            @endif
        </div>
    </a>
</div>
