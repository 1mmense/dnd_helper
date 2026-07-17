<x-layout>
    <x-slot:heading>
        Создать эффект
    </x-slot:heading>

    <form method="POST" action="/bestiary/templates">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-white">Создать новый эффект</h2>
                <p class="mt-1 text-sm/6 text-gray-400">Заполните поля.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8">
                    <x-form-field>
                        <x-form-label for="name">Название</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                id="name"
                                name="name"
                                placeholder="Новый эффект"
                                :value="old('name')"
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
                                :value="old('color')"
                                required
                            >
                            </x-form-input>

                            <x-form-error for="color"></x-form-error>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/bestiary/templates" class="text-sm/6 font-semibold text-white">
                Отмена
            </a>

            <x-form-button>Сохранить</x-form-button>
        </div>
    </form>
</x-layout>
