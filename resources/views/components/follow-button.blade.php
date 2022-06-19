<div>
    <button wire:click="follow({{ $user->id }})"
            class="bg-black hover:opacity-75 transition ease-in px-3 py-1 rounded-full text-white">
        {{ __('Follow') }}
    </button>
</div>
