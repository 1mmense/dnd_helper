<div>
    <livewire:popup.duration
        popup_title="Изменить длительность"
        submit_button_text="Применить"
    />

    <livewire:popup.add-effect
        popup_title="Добавить эффект"
        submit_button_text="Применить"
    />

    <livewire:popup.initiative
        popup_title="Изменить инициативу"
        submit_button_text="Применить"
    />

    <div class="flex flex-col gap-2">
        <div class="flex text-xl items-center">
            Раунд #
            {{ $roundNumber }}
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
                wire:confirm="Точно сбросить текущий список?"
                wire:click="resetOrder"
                class="
                    bg-black/20 text-gray-300 border-white/30
                    hover:bg-white/25 hover:text-white
                    font-medium ease-in-out duration-150
                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                    px-4 py-2
                "
            >
                Сброс
            </button>
        </div>

        @foreach ($creatures as $creature)
            <div wire:key="{{ $creature->id }}"
                class="
                    rounded-[10px] px-4 pb-4 pt-4 bg-red-800/20
                    {{ $creature->is_active ? 'border-8 border-red-500 mb-2' : 'border border-white/30' }}
                "
            >
                @php
                    $effectsContainerId = "effects_container_{$creature->id}"
                @endphp

                <div class="mt-2 flex align-top">
                    <div class="
                        flex flex-col items-center justify-evenly mr-2 text-gray-300
                        py-4 px-4 gap-2 rounded-lg border border-white/30 bg-black/20
                    ">
                        <div class="flex">
                            <button
                                class="
                                    size-10 rounded-full bg-red-600/80 flex items-center justify-center text-lg font-semibold text-white
                                    border border-white/30
                                "
                                wire:click="$dispatch(
                                    'open-ini-popup', {
                                        creatureId: {{ $creature->id }},
                                        initiative: {{ $creature->initiative }}
                                    }
                                )"
                            >
                                {{ $creature->initiative }}
                            </button>
                        </div>

                        <div class="flex flex-col gap-1">
                            <button class="px-2 py-1 bg-black/30 rounded border border-white/30 hover:bg-white/15">
                                Выше
                            </button>
                            <button class="px-2 py-1 bg-black/30 rounded border border-white/30 hover:bg-white/15">
                                Ниже
                            </button>
                        </div>
                    </div>

                    <div id="{{ $effectsContainerId }}"
                        class="group w-full"
                    >
                        <div
                            class="flex items-center justify-between gap-4 px-4 py-3 font-medium text-white"
                        >
                            <div class="flex-col">
                                <span class="text-xs text-gray-400">
                                    {{ App\Enums\CreatureType::getLabel($creature->type) }}
                                </span>

                                <h3 class="mt-0.5 text-lg font-medium text-white">
                                    <strong>{{ $creature->name }}</strong>
                                </h3>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-1 p-4 border-t border-white/30">
                            <button
                                wire:click="$dispatch(
                                    'open-effects-popup', {
                                        creatureId: {{ $creature->id }}
                                    }
                                )"
                                class="
                                    bg-black/20 text-gray-300 border-white/30
                                    hover:bg-white/25 hover:text-white
                                    font-medium ease-in-out duration-150
                                    inline-flex items-center overflow-hidden rounded-full border text-xs transition
                                    px-4 py-2
                                "
                            >
                                Добавить эффект...
                            </button>

                            @foreach ($creature->effects->all() as $effect)
                                @php
                                    $hasDuration = !empty($effect->effect_data->duration);
                                @endphp

                                <span
                                    class="
                                        {{ $effect->color }}
                                        inline-flex items-center p-0 overflow-hidden rounded-full border text-xs
                                        cursor-pointer
                                    "
                                    type="button"
                                >
                                    <button
                                        class="
                                            inline-flex items-center justify-center
                                            py-2 pl-1 pr-0.5
                                            border-r border-inherit
                                            hover:bg-black/20 transition-colors
                                        "
                                        wire:click="removeEffect({{ $creature->id }}, {{ $effect->id }})"
                                        type="button"
                                    >
                                        <svg
                                            class="size-4"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2.5"
                                            stroke="currentColor"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <span class="py-2 px-3 font-medium"
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
                                                py-2 pl-1.5 pr-2
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
            </div>
        @endforeach
    </div>
</div>
