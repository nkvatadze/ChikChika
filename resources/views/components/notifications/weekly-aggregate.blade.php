<div
    class="w-full border-b border-gray-200 flex justify-start items-start hover:bg-gray-50 rounded cursor-pointer pl-6 pr-6 pb-4 pt-10">
    <x-application-logo class="cursor-pointer w-16 h-16"/>
    <div class="ml-5 flex flex-col">
        <div class="mt-5">
            <p>{{ __('For the past 1 week you followed ') }}<span
                    class="font-bold">{{ $followingUsersCount }}</span> {{ __('Users and ') }}
                <span>{{ $followerUsersCount }}</span> {{ __('followed you.') }}</p>
        </div>
    </div>
</div>
