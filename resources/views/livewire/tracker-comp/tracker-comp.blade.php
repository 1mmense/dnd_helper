<div>
    <x-popup-window
        window_title="Добавить эффект"
        close_button_text="Добавить"
    >
        @foreach ($effects as $effect)
            {{ $effect->name }}
        @endforeach
    </x-popup-window>

    <livewire:modal-wrapper
        window_title="Изменить длительность"
        close_button_text="Применить"
    />

    @foreach ($creatures as $creature)
        <div class="mb-4 rounded-[10px] border border-white/30 bg-red-800/20 px-4 pb-4 pt-4">
            <time class="block text-xs text-gray-400" datetime="2022-10-10">
                {{ App\Enums\CreatureType::getLabel($creature->type) }}
            </time>

            {{-- <a href="#"> --}}
                <h3 class="mt-0.5 text-lg font-medium text-white">
                    {{ $creature->name }}
                </h3>
            {{-- </a> --}}

            @php
                $effectsContainerId = "effects_container_{$creature->id}"
            @endphp

            <div class="mt-2">
                <details id="{{ $effectsContainerId }}"
                    class="group [&_summary::-webkit-details-marker]:hidden rounded-lg border border-white/30 bg-black/20"
                    @if (!isset($this->effectContainers[$effectsContainerId]))
                        open
                    @endif
                >
                    <summary
                        wire:click="toggleEffectContainer('{{ $effectsContainerId }}')"
                        class="flex cursor-pointer items-center justify-between gap-4 px-4 py-3 font-medium text-white"
                    >
                        <span class="text-gray-300">Эффекты</span>

                        <svg
                            class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
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
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </summary>

                    <div class="flex flex-wrap gap-1 p-4 border-t border-white/30">
                        <x-popup-button
                            wire:click="$wire.showModal = true"
                            class="
                                bg-black/20 text-gray-300 border-white/30
                                hover:bg-white/25 hover:text-white
                                font-medium ease-in-out duration-150
                                inline-flex items-center overflow-hidden rounded-full border text-xs transition
                                px-4 py-2
                            "
                        >
                            Добавить...
                        </x-popup-button>

                        @foreach ($creature->effects->all() as $effect)
                            @php
                                // $creatureEffect = $creature->effects->find($effect->id);
                                $hasDuration = !empty($effect->effect_data->duration);
                            @endphp

                            <span
                                class="
                                    {{ $effect->color }}
                                    inline-flex items-center p-0 overflow-hidden rounded-full border text-xs transition
                                    cursor-pointer
                                "
                                type="button"
                            >
                                <button
                                    {{-- wire:click="$wire.showModal = true" --}}
                                    class="
                                        inline-flex items-center justify-center
                                        py-2 pl-1 pr-0.5
                                        border-r border-inherit
                                        hover:bg-black/20 transition-colors
                                    "
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

                                <span class="py-2 px-3 font-medium">
                                    {{ $effect->name }}
                                </span>

                                @if ($hasDuration)
                                    <button
                                        wire:click="$dispatch('open-duration', { duration: '{{ $effect->effect_data->duration }}' })"
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
                </details>
            </div>
        </div>
    @endforeach
</div>
