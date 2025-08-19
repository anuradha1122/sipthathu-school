<div class="bg-black py-4 md:py-8">
    <div class="flex flex-col gap-3">

        @if ($image)
            <img src="{{ $image }}"
                 class="object-cover aspect-square w-14 rounded-full m-auto border-2 border-white"
                 alt="User image"
                 id="user_image">
        @else
            <div class="flex items-center justify-center aspect-square w-14 bg-white text-black font-bold rounded-full m-auto border-2 border-white">
                {{ strtoupper(substr($heading, 0, 1)) }}
            </div>
        @endif

        <p class="text-3xl font-bold text-center text-white">
            {{ $heading }}
        </p>

        <p class="text-center text-gray-300">
            {{ $subHeading }}
        </p>
    </div>
</div>

