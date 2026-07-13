@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        popup_title="{{ $popup_title }}"
        wire:model="initiativePopupDisplayFlag"
    >
        <div class="my-4 flex-col items-center justify-between">
            <form wire:submit="updateInitiative">
                @csrf

                <x-numeric-input
                    wire:model="initiative"
                />

                <input type="hidden" wire:model="creatureId" value="{{ $creatureId }}" />

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
