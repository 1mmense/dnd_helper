<div>
    <div class="flex items-center">
        <!-- Кнопка "-" -->
        <button
            type="button"
            @click="
                $refs.input.stepDown();
                $refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            "
            class="
                flex items-center justify-center w-10 h-10 rounded-l-full transition duration-200 text-white text-xl font-medium border-t border-b border-l border-white/20
                hover:bg-white/15
            "
        >
            &minus;
        </button>

        <!-- Поле ввода -->
        <input
            type="number"
            min="1"
            class="
                w-16 h-10 text-center border-t border-b focus:outline-none focus:ring-0 text-lg font-medium [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                bg-transparent border-white/20 text-white
            "
            autofocus
            x-ref="input"
            {{ $attributes }}
        />

        <!-- Кнопка "+" -->
        <button
            type="button"
            @click="
                $refs.input.stepUp();
                $refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            "
            class="
                flex items-center justify-center w-10 h-10 rounded-r-full transition duration-200 text-xl font-medium
                bg-transparent border-white/20 text-white
                border-t border-b border-r
                hover:bg-white/5
            "
        >
            &plus;
        </button>
    </div>
</div>
