<div class="fixed inset-0 flex items-center justify-center z-50"
    wire:show="showFlag"
    style="display: none;"
>
    <div class="absolute inset-0 bg-black/50"
        @if ($showFlag)
            wire:click="$set('showFlag', false)"
            wire:keydown.escape.window="$set('showFlag', false)"
        @endif
    >
    </div>

    <div class="
        p-6 relative bg-red-950 text-gray-300 border border-white/30 rounded-lg shadow-lg
        w-fit min-w-[23rem] max-w-[90vw] md:max-w-2xl lg:max-w-4xl shrink-0
    ">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold whitespace-nowrap md:whitespace-normal break-words">
                {!! $popupTitle !!}
            </h2>

            <button
                type="button"
                class="
                    p-2 rounded-full transition-colors
                    hover:bg-white/30 hover:text-gray-900
                "
                aria-label="Close"
                wire:click="$set('showFlag', false)"
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
