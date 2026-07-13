<x-layout>
    <x-slot:heading>
        Эффект
    </x-slot:heading>

    @php
        $shadowString = "shadow-[0_0_10px_3px_var(--tw-shadow-color)] shadow-{$effect->color}";
        $textShadowString = "[text-shadow:0_0_10px_var(--tw-shadow-color)] shadow-{$effect->color}";
    @endphp

    <h2 class="
        text-lg font-bold text-{{ $effect->color }}
        {{ $textShadowString }}
    ">
        {{ $effect->name }}
    </h2>

    <p class="mt-6">
        <x-form-button href="/effects/{{ $effect->id }}/edit">Редактировать</x-form-button>
    </p>
</x-layout>
