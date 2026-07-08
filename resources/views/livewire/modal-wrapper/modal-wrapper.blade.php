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

                <div class="my-4 flex-col items-center justify-between">
                    <form wire:submit="updateDuration">
                        @csrf

                        <div class="flex items-center">
                            <!-- Кнопка "-" -->
                            <button
                                type="button"
                                wire:click="decrement"
                                class="
                                    flex items-center justify-center w-10 h-10 rounded-l-full transition duration-200 text-white text-xl font-medium border-t border-b border-l border-white/20
                                    @if($duration <= 0)
                                        disabled
                                        cursor-not-allowed
                                    @else
                                        hover:bg-white/15
                                    @endif
                                "
                                @if($duration <= 0)
                                    disabled
                                @endif
                            >
                                &minus;
                            </button>

                            <!-- Поле ввода -->
                            <input
                                type="number"
                                wire:model="duration"
                                min="0"
                                class="
                                    w-16 h-10 text-center border-t border-b focus:outline-none focus:ring-0 text-lg font-medium [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                                    bg-transparent border-white/20 text-white
                                "
                            />

                            <!-- Кнопка "+" -->
                            <button
                                type="button"
                                wire:click="increment"
                                class="
                                    flex items-center justify-center w-10 h-10 rounded-r-full transition duration-200 text-xl font-medium
                                    bg-transparent border-white/20 text-white
                                    border-t border-b border-r
                                    hover:bg-white/5
                                "
                            >
                                &plus;
                            </button>

                            @error('duration')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <input type="hidden" wire:model="creatureId" value="{{ $creatureId }}" />
                        <input type="hidden" wire:model="effectId" value="{{ $effectId }}" />

                        <button
                            class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/20 hover:bg-white/15"
                            type="submit"
                        >
                            {{ $close_button_text }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
