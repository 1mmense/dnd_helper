<div>
    <livewire:popup.duration
        popup_title="Изменить длительность"
        submit_button_text="Применить"
    />

    <livewire:popup.add-effect
        popup_title="Добавить эффект"
        submit_button_text="Применить"
    />

    <livewire:popup.creature
        popup_title="Добавить существо"
        submit_button_text="Применить"
    />

    <div class="flex flex-col gap-2">
        <div class="flex text-xl items-center">
            Раунд #{{ $roundNumber }}
        </div>

        <div class="my-2 flex items-center gap-2">
            <button
                wire:click="nextTurn"
                class="
                    bg-black/20 text-gray-300 border-white/30
                    hover:bg-white/25 hover:text-white
                    font-medium ease-in-out duration-150
                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                    px-4 py-2
                "
            >
                Следующий ход
            </button>

            <button
                wire:click="$dispatch('open-creature-popup')"
                class="
                    bg-black/20 text-gray-300 border-white/30
                    hover:bg-white/25 hover:text-white
                    font-medium ease-in-out duration-150
                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                    px-4 py-2
                "
            >
                Добавить существо
            </button>

            <button
                wire:confirm="Сбросить и отсортировать текущий список?"
                wire:click="resetOrder"
                class="
                    bg-black/20 text-gray-300 border-white/30
                    hover:bg-white/25 hover:text-white
                    font-medium ease-in-out duration-150
                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                    px-4 py-2
                "
            >
                Сброс + сортировка
            </button>
        </div>

        @foreach ($creatures as $creature)
            <div wire:key="{{ $creature->id }}"
                class="
                    flex gap-2
                    rounded-[10px] pl-2 bg-red-800/20
                    border border-white/30
                    {{ $creature->is_active ? 'shadow-[0_0_16px_0_var(--tw-shadow-color)] shadow-red-600 mb-2' : '' }}
                "
            >
                @php
                    $effectsContainerId = "effects_container_{$creature->id}"
                @endphp

                <div class="py-2 flex w-full align-top">
                    <div id="{{ $effectsContainerId }}"
                        class="flex flex-col w-full gap-2"
                    >
                        <div class="flex items-center justify-start gap-2 font-medium text-white">
                            <div class="flex">
                                <button
                                    class="
                                        size-10 rounded-full bg-red-600/80 flex items-center justify-center text-lg font-semibold text-white
                                        border border-white/30
                                    "
                                    wire:click="$dispatch(
                                        'open-creature-popup', {
                                            creatureId: {{ $creature->id }}
                                        }
                                    )"
                                >
                                    {{ $creature->initiative }}
                                </button>
                            </div>

                            <div class="flex flex-col items-start align-middle">
                                <span class="text-xs text-gray-400">
                                    {{ App\Enums\CreatureType::getLabel($creature->type) }}
                                </span>

                                <span class="text-lg font-medium text-white">
                                    <strong>{{ $creature->name }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="pt-2 flex flex-wrap gap-1 border-t border-white/30">
                            <button
                                wire:click="$dispatch(
                                    'open-effects-popup', {
                                        creatureId: {{ $creature->id }}
                                    }
                                )"
                                class="
                                    bg-black/20 text-gray-300 border-white/30 font-medium
                                    hover:bg-white/25 hover:text-white
                                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                                    px-2 py-1
                                "
                            >
                                Добавить эффект...
                            </button>

                            @foreach ($creature->effects->all() as $effect)
                                @php
                                    $hasDuration = !empty($effect->effect_data->duration);

                                    $shadowString = "shadow-[0_0_5px_0_var(--tw-shadow-color)] shadow-{$effect->color}";
                                @endphp

                                <span
                                    class="
                                        {{ $effect->colorString }}
                                        inline-flex items-center p-0 overflow-hidden rounded-full border text-xs
                                        cursor-pointer
                                        {{ $shadowString }}
                                    "
                                    type="button"
                                >
                                    <button
                                        class="
                                            inline-flex items-center justify-center
                                            py-1 pl-1 pr-0.5 min-w-5
                                            border-r border-inherit
                                            hover:bg-black/20 transition-colors
                                        "
                                        wire:click="removeEffect({{ $creature->id }}, {{ $effect->id }})"
                                        type="button"
                                    >
                                        {{-- <svg
                                            class="size-2"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2.5"
                                            stroke="currentColor"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg> --}}
                                        &#x2717;
                                    </button>

                                    <span class="py-1 px-1 font-medium"
                                        wire:click="$dispatch(
                                            'open-duration-popup', {
                                                creatureId: {{ $creature->id }},
                                                effectId: {{ $effect->id }},
                                                duration: {{ $effect->effect_data->duration ?? 0 }}
                                            }
                                        )"
                                    >
                                        {{ $effect->name }}
                                    </span>

                                    @if ($hasDuration)
                                        <button
                                            wire:click="$dispatch(
                                                'open-duration-popup', {
                                                    creatureId: {{ $creature->id }},
                                                    effectId: {{ $effect->id }},
                                                    duration: {{ $effect->effect_data->duration }}
                                                }
                                            )"
                                            class="
                                                inline-flex items-center justify-center
                                                py-1 pl-0.5 pr-1 min-w-5
                                                border-l border-inherit
                                                hover:bg-black/30 transition-colors
                                            "
                                        >
                                            {{ $effect->effect_data->duration }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div>
                    <button
                        wire:confirm="Удалить существо?"
                        wire:click="destroyCreature({{ $creature->id }})"
                        class="h-full px-1 py-1 bg-black/30 rounded-r-[10px] border-l border-white/30 hover:bg-white/15"
                    >
                        &#x2717;
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
