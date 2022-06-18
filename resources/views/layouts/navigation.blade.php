<nav class="h-full block fixed shadow-md bg-white grid grid-cols-2 grid-rows-3 px-2">
    <div class="col-start-2 row-start-1 row-end-3 col-end-3 flex flex-col justify-start items-end px-10">
        <div class="flex flex-col justify-start items-baseline">
            <div
                class="mt-5 ml-4 inline-block rounded-full hover:text-blue-600 hover:bg-blue-50 cursor-pointer transition duration-300 ease-in-out fill-current">
                <x-application-logo
                    class="cursor-pointer  w-16 h-16"/>
            </div>

            <div
                class="flex flex-row justify-between items-center mt-3 py-2 rounded-full px-5 ml-2 hover:text-blue-600
                hover:bg-blue-50 cursor-pointer transition duration-300 ease-in-out text-left">
                <img src="{{ asset('images/bird-house.png') }}" class="w-10 h-10 mr-1" alt="#">
                <a class="text-lg text-ellipsis whitespace-nowrap rounded "
                   href="{{ route('home') }}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
                    <span>{{ __('Home') }}</span>
                </a>
            </div>
        </div>
    </div>
    <div
        class="col-start-2 col-end-3 row-start-3 flex flex-col justify-end items-end px-10 py-10 mt-3">
        <a class="text-lg text-ellipsis whitespace-nowrap rounded "
           href="{{ route('users.edit') }}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
            <div
                class="flex flex-row justify-between items-center mt-3 py-2 rounded-full px-5 ml-2 hover:text-blue-600
                hover:bg-blue-50 cursor-pointer transition duration-300 ease-in-out">
                <img src="{{ asset('images/settings.png') }}" class="w-10 h-10" alt="#">

                <span>{{ __('Settings') }}</span>
            </div>
        </a>

        <div class="">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="flex flex-row justify-between items-center text-lg text-gray-700 text-ellipsis whitespace-nowrap py-2 px-5 rounded-full hover:text-blue-600
                hover:bg-blue-50 cursor-pointer transition duration-300 ease-in-out"
                    type="submit">
                    <img src="{{ asset('images/logout.png') }}" class="w-8 h-8" alt="#">
                    <span>{{ __('Logout') }}</span>
                </button>

            </form>
        </div>
    </div>
</nav>
