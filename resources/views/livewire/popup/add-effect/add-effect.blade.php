@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        popup_title="{{ $popup_title }}"
        wire:model="effectsPopupDisplayFlag"
    >
        <div class="my-4 flex-col items-center justify-between">
            <form wire:submit="updateEffects">
                @csrf

                <!--
                    TODO:
                    + кастомный селект
                    - поле поиска;
                    - поиск по мере ввода;
                    - бесконечная прокрутка;
                    - подгрузка следующей страницы только при достижении низа;
                -->

                <div class="my-4"
                    wire:ignore
                >
                    <livewire:select
                        :items="$effects"
                        label="Выберите эффект"
                        wire:model.live="selectedEffectId"
                        wire:key="select-effect-{{ $selectedEffectId ?? 'empty' }}"
                    />
                </div>

                @if ($selectedEffectId)
                    <div>
                        <x-duration-input
                            wire:model="duration"
                        />

                        @error('duration')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <button class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/20 hover:bg-white/15"
                    type="submit"
                >
                    {{ $submit_button_text }}
                </button>
            </form>
        </div>
    </livewire:popup.popup>
</div>
