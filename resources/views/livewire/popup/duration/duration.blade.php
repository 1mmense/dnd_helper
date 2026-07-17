@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        :eventTarget="$eventTarget"
    >
        {{-- TO BE REMOVED --}}
        <div class="my-4 flex-col items-center justify-between">
            <form wire:submit="updateDuration">
                @csrf

                <div class="w-full flex flex-col items-start justify-center">
                    <label for="selectedEffectId" class="text-sm font-medium">
                        Укажите длительность эффекта
                    </label>

                    <x-numeric-input
                        wire:model="duration"
                    />

                    <x-form-error for="duration" />
                </div>

                <input type="hidden" wire:model="creatureId" value="{{ $creatureId }}" />
                <input type="hidden" wire:model="effectId" value="{{ $effectId }}" />

                <button
                    class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/30 hover:bg-white/15"
                    type="submit"
                >
                    {{ $submit_button_text }}
                </button>
            </form>
        </div>
    </livewire:popup.popup>
</div>
