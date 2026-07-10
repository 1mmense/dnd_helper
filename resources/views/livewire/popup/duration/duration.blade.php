@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        popup_title="{{ $popup_title }}"
        wire:model="durationPopupDisplayFlag"
    >
        <div class="my-4 flex-col items-center justify-between">
            <form wire:submit="updateDuration">
                @csrf

                <div>
                    <x-duration-input
                        wire:model="duration"
                    />
                </div>

                <input type="hidden" wire:model="creatureId" value="{{ $creatureId }}" />
                <input type="hidden" wire:model="effectId" value="{{ $effectId }}" />

                <button
                    class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/20 hover:bg-white/15"
                    type="submit"
                >
                    {{ $submit_button_text }}
                </button>
            </form>
        </div>
    </livewire:popup.popup>
</div>
