<x-app-layout>
    <div class="py-4 m-10 grid grid-cols-3">
        <div class="col-span-1">
            <h1 class="text-2xl">{{ __('Update Personal Information') }}</h1>
            <h3 class="text-md mt-3">{{ __('You can edit your personal information here') }}</h3>
        </div>
        <div class="col-span-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-3 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
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
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">
                            <label class="col-span-1 text-lg mr-5" for="username">
                                {{ __('Username') }}
                            </label>

                            <input type="text" name="username"
                                   class="col-span-2 px-3 py-1 @error('username') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="username" value="{{ auth()->user()->username }}">

                        </div>
                        <div class="ml-10">
                            @error('username')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">
                            <label class="col-span-1 text-lg mr-5" for="username">
                                {{ __('Bio') }}
                            </label>

                            <textarea name="bio" rows="3" id="bio" class="col-span-2 w-full px-3 py-1 @error('username') border-2
                            border-red-400 @else border-gray-400 @enderror w-1/2 rounded">{{ auth()->user()->bio }}</textarea>

                        </div>
                        <div class="ml-10">
                            @error('bio')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5">
                            <label class="col-span-1 text-lg mr-5" for="username">
                                {{ __('Profile Image') }}
                            </label>

                            <input type="file" name="profile_image"
                                   class="col-span-2  px-3 py-1 @error('profile_image') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="profile_image">
                        </div>
                        <div class="ml-10">
                            @error('profile_image')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-1/5 mt-5 rounded">
                            <img class="rounded" src="{{ auth()->user()->profile_image_url }}" alt="">
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
        {{-- Security information --}}
        <div class="col-span-1 mt-20">
            <h1 class="text-2xl">{{ __('Security information') }}</h1>
            <h3 class="text-md mt-3">{{ __('You can update your security information here, like change password') }}</h3>
        </div>
        <div class="col-span-2 mt-20">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-3 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">

                            <label class="col-span-1 text-lg mr-5" for="old_password">
                                {{ __('Current Password') }}
                            </label>

                            <input type="password" name="old_password"
                                   class="col-span-2 w-full px-3 py-1 @error('old_password') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="old_password">
                        </div>
                        <div class="ml-10">
                            @error('old_password')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">
                            <label class="col-span-1 text-lg mr-5" for="new_password">
                                {{ __('New Password') }}
                            </label>

                            <input type="password" name="password"
                                   class="col-span-2 px-3 py-1 @error('password') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="password">

                        </div>
                        <hr>
                        <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">
                            <label class="col-span-1 text-lg mr-5" for="password_confirmation">
                                {{ __('Confirm New Password') }}
                            </label>

                            <input type="password" name="password_confirmation"
                                   class="col-span-2 px-3 py-1 @error('password.confirm') border-2 border-red-400 @else border-gray-400 @enderror w-1/2 rounded"
                                   id="password_confirmation">

                        </div>
                        <div class="ml-10">
                            @error('password')
                            <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-right mt-2">
                            <button class="bg-cyan-500 text-white py-1 px-3 rounded text-md hover:bg-cyan-600"
                                    type="submit">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- API credentials --}}
        <div class="col-span-1 mt-20">
            <h1 class="text-2xl">{{ __('Get API credentials') }}</h1>
            <h3 class="text-md mt-3">{{ __('You can generate API bearer token to authorize API calls') }}</h3>
        </div>
        <div class="col-span-2 mt-20">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:access-token>

                </livewire:access-token>
            </div>
        </div>
    </div>
</x-app-layout>
