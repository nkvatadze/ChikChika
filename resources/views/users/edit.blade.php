<x-app-layout>
    <div class="py-4 m-10 grid grid-cols-3">
        <div class="col-span-1">
            <h1 class="text-2xl">Update Personal Information</h1>
            <h3 class="text-md mt-3">You can edit your personal information here</h3>
        </div>
        <div class="col-span-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-3 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('users.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="flex justify-start items-center mb-5">
                            <label class="text-lg mr-5" for="is_private">
                                {{ __('Private account') }}
                            </label>
                            <input class="without-outline @error('is_private') border border-red-700 @enderror"
                                   type="checkbox" name="is_private" id="is_private"
                                   value="1"
                                {{ auth()->user()->is_private ? 'checked' : '' }}>
                        </div>

                        <div>
                            @error('is_private')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">

                            <label class="col-span-1 text-lg mr-5" for="name">
                                {{ __('Name to display') }}
                            </label>

                            <input type="text" name="username"
                                   class="col-span-2 w-full px-3 py-1 @error('name') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="name" value="{{ auth()->user()->name }}">

                        </div>
                        <div class="ml-10">
                            @error('name')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5">
                            <label class="col-span-1 text-lg mr-5" for="username">
                                {{ __('Username') }}
                            </label>

                            <input type="text" name="username"
                                   class="col-span-2 w-full px-3 py-1 @error('username') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="username" value="{{ auth()->user()->username }}">

                        </div>
                        <div class="ml-10">
                            @error('username')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-right mt-2">
                            <button class="bg-cyan-500 text-white py-1 px-3 rounded text-md hover:bg-cyan-600"
                                    type="submit">{{ __('Save') }}</button>
                        </div>
                        @error('message')
                        {{ $message }}
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
