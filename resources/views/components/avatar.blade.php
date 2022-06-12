<img {{ $attributes->merge([
    "class"=>"rounded-full overflow-hidden"
]) }} src="{{ auth()->user()->profile_image_url }}">
