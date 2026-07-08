<button
    wire:click="$wire.showModal = true"
    type="button"
    {{-- {{ $attributes->merge([
        // 'class' => 'inline-flex items-center px-5 text-sm font-medium leading-5 transition ease-in-out duration-150 rounded-full border
        //     bg-black/20 text-gray-300 border-white/30 ring-white/30
        //     hover:bg-white/25 hover:text-white
        //     focus:outline-none focus:ring focus:border-white/30',
        // 'type'  => 'button',
    ]) }} --}}
    {{ $attributes }}
>
    {{ $slot }}
</button>
