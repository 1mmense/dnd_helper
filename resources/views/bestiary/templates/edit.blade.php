<x-layout>
    <x-slot:heading>
        Редактирование эффекта: {{ $template->name }}
    </x-slot:heading>

    <form method="POST" action="/bestiary/templates/{{ $template->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8">
                    <x-form-field>
                        <x-form-label for="name">Название</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                id="name"
                                name="name"
                                value="{{ $template->name }}"
                                required
                            >
                            </x-form-input>

                            <x-form-error for="name"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="color">Цвет</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                id="color"
                                name="color"
                                value="{{ $template->color }}"
                                required
                            >
                            </x-form-input>

                            <x-form-error for="color"></x-form-error>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button
                    class="text-sm/6 font-semibold text-red-500"
                    form="delete_form"
                    onclick="return confirm('Удалить эффект \'{{ $template->name }}\'?')"
                >
                    Удалить
                </button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/bestiary/templates" class="text-sm/6 font-semibold text-white">
                    Отмена
                </a>

                <button
                    class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                    type="submit"
                >
                    Сохранить изменения
                </button>
            </div>
        </div>
    </form>

    <form
        id="delete_form"
        class="hidden"
        method="POST"
        action="/bestiary/templates/{{ $template->id }}"
    >
        @csrf
        @method('DELETE')
    </form>
</x-layout>
