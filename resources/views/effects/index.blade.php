<x-layout>
    <x-slot:heading>
        Эффекты
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
            href="/effects/create"
        >
            Добавить эффект...
        </a>

        @foreach ($effects as $effect)
            @php
                $shadowString = "shadow-[0_0_10px_3px_var(--tw-shadow-color)] shadow-{$effect->color}";
                $textShadowString = "[text-shadow:0_0_10px_var(--tw-shadow-color)] shadow-{$effect->color}";
            @endphp

            <a href="/effects/{{ $effect->id }}/edit"
                class="
                    flex flex-col gap-2 px-4 py-6 items-center
                    border
                    {{ $effect->colorString }}
                    {{ $shadowString }}
                "
            >
                <p class="
                    font-bold
                    text-{{ $effect->color }}
                    {{ $textShadowString }}
                ">
                    {{ $effect->name }}
                </p>
            </a>
        @endforeach
    </div>
</x-layout>
