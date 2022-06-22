<div class="fixed top-5 right-40 w-1/4 flex flex-col items-center justify-center">
    <input wire:model.debounce.500ms="search" class="search-icon rounded-full w-3/5" type="text" name="search"
           id="search" placeholder="Search people" autocomplete="off">

    @if($users->isNotEmpty())
        <div class="w-full bg-white border border-gray-300 rounded-md mt-2">
            @foreach($users as $user)
                <div class="flex justify-start items-center hover:bg-gray-100 p-5">
                    <a href="{{ route('users.show', ['user'=>$user['username']]) }}" class="w-full">

                        <div class="flex justify-start items-center">
                            <x-avatar class="w-16  h-16 mr-5" :src="$user['profile_image_url']"/>
                            <div class="flex flex-col">
                                <p class="font-bold hover:underline">{{ $user['name'] }}</p>
                                <p><span>@</span>{{ $user['username'] }}</p>
                                <p class="whitespace-nowrap text-ellipsis overflow-hidden max-w-sm">{{ $user['bio'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
