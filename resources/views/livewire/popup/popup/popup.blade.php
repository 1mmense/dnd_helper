@props([
    'popup_title' => 'Popup title'
])

<div class="fixed inset-0 flex items-center justify-center z-50" wire:show="show_flag" style="display: none;">
    <div class="absolute inset-0 bg-black/50"
        wire:click="$set('show_flag', false)"
        wire:keydown.escape.window="$set('show_flag', false)"
    >
    </div>

    <div class="
        relative bg-red-950 text-gray-300 border-2 border-white/30 p-6 rounded-lg shadow-lg max-w-md w-full
    ">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ $popup_title }}</h2>

            <button
                type="button"
                class="
                    p-2 rounded-full transition-colors
                    hover:bg-white/30 hover:text-gray-900
                "
                aria-label="Close"
                wire:click="$set('show_flag', false)"
            >
                <svg class="size-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
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

        {{ $slot }}
    </div>
</div>
