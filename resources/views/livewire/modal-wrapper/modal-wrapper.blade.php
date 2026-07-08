@props([
    'window_title', 'close_button_text'
])

<div>
    @if ($showEffects)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/60" wire:click="$set('showEffects', false)"></div>

            <div class="relative z-10 w-full max-w-md rounded-xl bg-slate-800 p-6 text-white shadow-xl">
                <h3 class="mb-2 text-xl font-bold">Настройки системы</h3>
                <p>Здесь уникальный контент для настроек...</p>

                <button class="mt-4 rounded bg-red-500 px-3 py-1"
                    wire:click="$set('showEffects', false)"
                >
                    Закрыть
                </button>
            </div>
        </div>
    @endif

    @if ($showDuration)
        {{-- <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/60"
                wire:click="$set('showDuration', false)"
            >
            </div>

            <div class="relative z-10 w-full max-w-md rounded-xl bg-slate-800 p-6 text-white shadow-xl">
                <h3 class="mb-2 text-xl font-bold">Профиль игрока</h3>
                <p>{{ $duration }}</p>

                <button class="mt-4 rounded bg-red-500 px-3 py-1"
                    wire:click="$set('showDuration', false)"
                >
                    Закрыть
                </button>
            </div>
        </div> --}}

        <div class="fixed flex inset-0 items-center justify-center z-50 bg-black/50"
            wire:click="$set('showDuration', false)"
            wire:keydown.escape.window="$set('showDuration', false)"
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
                            hover:bg-white/30 hover:text-gray-900
                        "
                        aria-label="Close"
                        wire:click="$set('showDuration', false)"
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
                    {{ $duration }}
                </div>

                <button wire:click="$set('showDuration', false)"
                    class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/30"
                >
                    {{ $close_button_text }}
                </button>
            </div>
    @endif
</div>
