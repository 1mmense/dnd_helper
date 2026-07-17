<x-layout>
    <x-slot:heading>
        Шаблоны
    </x-slot:heading>

    <div class="
        gap-6 grid
        grid-cols-4
    ">
        <a
            class="
                bg-black/20 text-gray-300 border-white/30 font-medium
                hover:bg-white/25 hover:text-white
                overflow-hidden
                flex flex-col gap-2 px-4 py-6 items-center
                border
            "
            href="/bestiary/templates/create"
        >
            Добавить шаблон...
        </a>

        {{-- @foreach ($templates as $template)
            @php
                $shadowString = "shadow-[0_0_10px_3px_var(--tw-shadow-color)] shadow-{$template->color}";
                $textShadowString = "[text-shadow:0_0_10px_var(--tw-shadow-color)] shadow-{$template->color}";
            @endphp

            <a href="/bestiary/templates/{{ $template->id }}/edit"
                class="
                    flex flex-col gap-2 px-4 py-6 items-center
                    border
                    {{ $template->colorString }}
                    {{ $shadowString }}
                "
            >
                <p class="
                    font-bold
                    text-{{ $template->color }}
                    {{ $textShadowString }}
                ">
                    {{ $template->name }}
                </p>
            </a>
        @endforeach --}}
    </div>
</x-layout>
