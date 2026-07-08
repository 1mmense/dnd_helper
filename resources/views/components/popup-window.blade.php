@props([
    'window_title', 'close_button_text'
])

<div wire:show="showModal"
    class="fixed flex inset-0 items-center justify-center z-50 bg-black/50"
    style="display: none;"
    wire:click.self="$wire.showModal = false"
    wire:keydown.escape.window="$wire.showModal = false"
>
    <div
        class="
            bg-red-950 text-gray-300 border-2 border-white/30 p-6 rounded-lg shadow-lg max-w-md w-full
        "
        wire:click.stop
    >
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ $window_title }}</h2>

            <button
                type="button"
                class="
                    p-2 rounded-full transition-colors
                    focus:ring-2 focus:ring-white/30 focus:ring-offset-2 focus:ring-offset-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white/30 focus-visible:ring-offset-2 focus-visible:ring-offset-white focus-visible:outline-none
                    hover:bg-gray-50 hover:text-gray-900
                "
                aria-label="Close"
                wire:click="$wire.showModal = false"
            >
                <svg
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <div class="my-4">
            {{ $slot }}
        </div>

        <button wire:click="$wire.showModal = false" class="px-4 py-2 bg-black/30 rounded border border-white/30">
            {{ $close_button_text }}
        </button>
    </div>
</div>
