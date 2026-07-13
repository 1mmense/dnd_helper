@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        popup_title="{{ $popup_title }}"
        wire:model="effectsPopupDisplayFlag"
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

                <div class="w-full flex flex-col items-start justify-center">
                    <div
                        class="w-full"
                        wire:ignore
                    >
                        <livewire:select
                            :items="$effects"
                            label="Выберите эффект"
                            wire:model.live="selectedEffectId"
                        />
                    </div>

                    <x-form-error for="selectedEffectId"/>
                </div>

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
