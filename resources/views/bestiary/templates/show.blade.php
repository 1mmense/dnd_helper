<x-layout>
    <x-slot:heading>
        Эффект
    </x-slot:heading>

    @php
        $shadowString = "shadow-[0_0_10px_3px_var(--tw-shadow-color)] shadow-{$template->color}";
        $textShadowString = "[text-shadow:0_0_10px_var(--tw-shadow-color)] shadow-{$template->color}";
    @endphp

    <h2 class="
        text-lg font-bold text-{{ $template->color }}
        {{ $textShadowString }}
    ">
        {{ $template->name }}
    </h2>

    <p class="mt-6">
        <x-form-button href="/bestiary/templates/{{ $template->id }}/edit">Редактировать</x-form-button>
    </p>
</x-layout>
