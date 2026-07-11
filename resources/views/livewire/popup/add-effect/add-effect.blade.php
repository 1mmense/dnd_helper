@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        popup_title="{{ $popup_title }}"
        wire:model="effectsPopupDisplayFlag"
    >
        <div class="my-4 flex-col items-center justify-between">
            {{-- <form wire:submit="updateEffects"> --}}
                @csrf

                <!--
                    TODO:
                    - поле поиска;
                    - полностью кастомные элементы списка;
                    - поиск по мере ввода;
                    - бесконечная прокрутка;
                    - подгрузка следующей страницы только при достижении низа;
                -->

                <div class="my-4">
                    <livewire:select
                        {{-- :selected="1" --}}
                        :items="$effects"
                        label="Выберите эффект"
                    />
                </div>

                {{-- <input type="number" wire:model="duration" min="0" class="
                        w-16 h-10 text-center border-t border-b focus:outline-none focus:ring-0 text-lg font-medium [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                        bg-transparent border-white/20 text-white
                    " /> --}}

                {{-- @error('duration')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror --}}

                {{-- <input type="hidden" wire:model="creatureId" value="{{ $creatureId }}" />
                <input type="hidden" wire:model="effectId" value="{{ $effectId }}" /> --}}

                <button class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/20 hover:bg-white/15"
                    type="submit"
                >
                    {{ $submit_button_text }}
                </button>
            {{-- </form> --}}
        </div>
    </livewire:popup.popup>
</div>
