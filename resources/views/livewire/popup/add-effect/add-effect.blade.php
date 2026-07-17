@props([
    'submit_button_text'
])

<div>
    <livewire:popup.popup
        :eventTarget="$eventTarget"
    >
        <form wire:submit="updateEffects">
            <div class="my-4 flex flex-col gap-6 items-start justify-end">
                @csrf

                <!--
                    TODO:
                    + кастомный селект
                    - поле поиска;
                    - поиск по мере ввода;
                    - бесконечная прокрутка;
                    - подгрузка следующей страницы только при достижении низа;
                -->

                @if ($creaturesList)
                    <div class="w-full flex flex-col items-start justify-center">
                        <label for="selectedEffectId" class="text-sm font-medium">
                            Выберите источник эффекта
                        </label>

                        <div
                            class="w-full"
                        >
                            <livewire:select
                                :items="$creaturesList"
                                label="Источник эффекта"
                                wire:model.live="sourceCreatureId"
                            />
                        </div>

                        <x-form-error for="sourceCreatureId"/>
                    </div>
                @endif

                @if ($triggerTypesList)
                    <div class="w-full flex flex-col items-start justify-center">
                        <label for="triggerType" class="text-sm font-medium">
                            Выберите тип триггера
                        </label>

                        <div
                            class="w-full"
                        >
                            <livewire:select
                                :items="$triggerTypesList"
                                label="Тип триггера"
                                wire:model.live="triggerType"
                            />
                        </div>

                        <x-form-error for="triggerType"/>
                    </div>
                @endif

                @if ($effects)
                    <div class="w-full flex flex-col items-start justify-center">
                        <label for="triggerType" class="text-sm font-medium">
                            Выберите эффект
                        </label>

                        <div
                            class="w-full"
                        >
                            <livewire:select
                                :items="$effects"
                                label="Эффект"
                                wire:model.live="selectedEffectId"
                            />
                        </div>

                        <x-form-error for="selectedEffectId"/>
                    </div>
                @endif

                <div class="w-full flex flex-col items-start justify-center">
                    <x-numeric-input
                        wire:model="duration"
                    />

                    <x-form-error for="duration" />
                </div>
            </div>

            <button class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/30 hover:bg-white/15"
                type="submit"
            >
                {{ $submit_button_text }}
            </button>
        </form>
    </livewire:popup.popup>
</div>
