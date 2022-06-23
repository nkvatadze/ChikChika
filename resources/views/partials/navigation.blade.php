<nav class="h-full w-full max-w-lg block grid grid-cols-2 grid-rows-3  fixed shadow-md bg-white px-2">
    <div class="col-start-2 row-start-1 row-end-3 col-end-3 flex flex-col justify-start items-end px-10">
        <div class="flex flex-col justify-start items-end">
            <a href="{{ route('home') }}">
                <div
                    class="mt-5 ml-4 inline-block rounded-full hover:text-cyan-600 hover:bg-cyan-50 cursor-pointer transition duration-300 ease-in-out fill-current">
                    <x-application-logo class="cursor-pointer  w-16 h-16"/>
                </div>
            </a>

            <a class="text-ellipsis whitespace-nowrap rounded "
               href="{{ route('home') }}">
                <div
                    class="flex flex-row justify-between items-center mt-3 py-2 rounded-full px-5 ml-2 hover:text-cyan-600
                hover:bg-cyan-50 cursor-pointer transition duration-300 ease-in-out text-left">
                    <i class="mr-2 text-3xl fa-solid fa-tree"></i>
                    <span class="text-lg">{{ __('Home') }}</span>
                </div>
            </a>
            <a class="text-ellipsis whitespace-nowrap rounded"
               href="{{ route('notifications.index') }}">
                <div
                    class="relative flex flex-row justify-between items-center mt-3 py-2 rounded-full px-5 ml-2 hover:text-cyan-600
                hover:bg-cyan-50 transition duration-300 ease-in-out text-left">
                    <i class="z-10 relative mr-2 text-3xl fa-regular fa-bell"></i>
                    <span class="z-10 relative text-lg">{{ __('Notifications') }}</span>
                    @if($unreadNotifications)
                        <div class="absolute z-20 top-0 left-7 text-white rounded-full bg-cyan-500 text-xs px-1.5 py-0.5 border">
                            {{ $unreadNotifications }}
                        </div>
                    @endif
                </div>
            </a>
        </div>
    </div>
    @auth
        <div
            class="col-start-2 col-end-3 row-start-3 flex flex-col justify-end items-end px-10 py-10 mt-3">
            <a class="text-ellipsis whitespace-nowrap rounded "
               href="{{ route('users.edit') }}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
                <div
                    class="flex flex-row justify-between items-center mt-3 py-2 rounded-full px-5 ml-2 hover:text-cyan-600
                hover:bg-cyan-50 cursor-pointer transition duration-300 ease-in-out">
                    <i class="mr-2 text-xl fa-solid fa-gear"></i>
                    <span class="text-lg ">{{ __('Settings') }}</span>
                </div>
            </a>

            <div class="">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex flex-row justify-between items-center text-gray-700 text-ellipsis whitespace-nowrap
                        py-2 px-5 rounded-full hover:text-cyan-600 hover:bg-cyan-50 cursor-pointer transition
                        duration-300 ease-in-out" type="submit">
                        <i class="mr-2 text-xl fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="text-lg">{{ __('Logout') }}</span>
                    </button>

                </form>
            </div>
        </div>
    @endauth
</nav>
