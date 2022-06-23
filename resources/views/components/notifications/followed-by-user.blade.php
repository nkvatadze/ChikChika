@if($user)
    <a href="{{ route('users.show', ['user'=>$user->username]) }}">
        <div
            class="w-full border-b border-gray-200 flex justify-start items-start hover:bg-gray-50 rounded cursor-pointer px-6 py-4">
            <i class="text-cyan-700 text-3xl fa-solid fa-user"></i>
            <div class="ml-5 flex flex-col">
                <x-avatar class="w-10 h-10 mr-5" :src="$user->profile_image_url"/>
                <div class="mt-5">
                    <p><span class="font-bold">{{ $user->name }}</span> {{ __('Followed you') }}</p>
                </div>
            </div>
        </div>
    </a>
@endif
