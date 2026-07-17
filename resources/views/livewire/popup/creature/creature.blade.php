@props([
    'popup_title', 'submit_button_text'
])

<div>
    <livewire:popup.popup
        :eventTarget="$eventTarget"
    >
        <form
            wire:submit="updateCreature"
            class="my-4 flex flex-col items-start justify-between gap-4"
        >
            @csrf

            @if ($typesList)
                <div class="flex flex-col w-full justify-between gap-1">
                    <label class="text-sm font-medium">
                        Тип:
                    </label>

                    <livewire:select
                        :items="$typesList"
                        label="Тип существа"
                        wire:model="type"
                    />
                </div>

                <div class="-mt-3">
                    <x-form-error for="type"/>
                </div>
            @endif

            <div class="flex flex-col justify-between gap-1">
                <label for="name" class="text-sm font-medium">
                    Имя:
                </label>

                <input
                    wire:model="name"
                    type="text"
                    class="
                        w-full h-10 px-2 py-1 focus:outline-none focus:ring-0 text-lg font-medium [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                        bg-transparent border rounded border-white/30 text-white
                    "
                />

                <x-form-error for="name" />
            </div>

            <div class="flex flex-col justify-between gap-1">
                <label for="initiative" class="text-sm font-medium">
                    Инициатива:
                </label>

                <x-numeric-input
                    wire:model="initiative"
                />

                <x-form-error for="initiative" />
            </div>

            <input type="hidden" wire:model="creatureId" />

            <button
                class="mt-4 px-4 py-2 bg-black/30 rounded border border-white/30 hover:bg-white/15"
                type="submit"
            >
                {{ $submit_button_text }}
            </button>
        </form>
    </livewire:popup.popup>
</div>
