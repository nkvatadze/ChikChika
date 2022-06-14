@if (session()->has('success'))
    <div
        class="absolute bottom-5 right-5 py-2 px-5 text-green-500 bg-green-50 rounded-md flash-message">
        <strong class="mr-3">{{ session('success') }}</strong>
    </div>
@endif
@if (session()->has('danger'))
    <div
        class="absolute bottom-5 right-5 py-2 px-5 text-red-500 border border-red-500 rounded-md flash-message">
        <strong class="mr-3">{{ session('danger') }}</strong>
    </div>
@endif
@if (session()->has('warning'))
    <div
        class="absolute bottom-5 right-5 py-2 px-5 text-yellow-500 border border-yellow-500 rounded-md flash-message">
        <strong class="mr-3">{{ session('warning') }}</strong>
    </div>
@endif
