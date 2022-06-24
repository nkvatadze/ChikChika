<div class="px-6 pt-6 pb-3 bg-white border-b border-gray-200">
    <div class="grid grid-cols-3 justify-start items-center mt-5 mb-5">
        <label class="col-span-1 text-lg mr-5" for="token">
            {{ __('Bearer') }}
        </label>

        <input type="text" name="token" disabled
               class="col-span-2 w-3/4 px-3 py-1 @error('username') border-2 border-red-400 @else border-gray-400 @enderror rounded"
               id="token" value="{{ $token }}">
    </div>
    <div class="ml-10">
        @error('token')
        <div class="italic text-red-600 text-sm mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-right mt-2">
        <button wire:click="generate"
                class="bg-cyan-500 text-white py-1 px-3 rounded text-md hover:bg-cyan-600">
            {{ __('Generate token') }}
        </button>
    </div>
</div>
