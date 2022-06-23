@if($user)
    <a href="{{ route('users.show', ['user'=>$user->username]) }}">
        <div
            class="w-full border-b border-gray-200 flex justify-start items-start hover:bg-gray-50 rounded cursor-pointer pl-10 pr-6 pb-4 pt-10">
            <i class="text-cyan-700 text-3xl fa-solid fa-user-slash"></i>
            <div class="ml-5 flex flex-col">
                <x-avatar class="w-10 h-10 mr-5" :src="$user->profile_image_url"/>
                <div class="mt-5">
                    <p><span class="font-bold">{{ $user->name }}</span> {{ __('Unfollowed you') }}</p>
                </div>
            </div>
        </div>
    </a>
@endif
