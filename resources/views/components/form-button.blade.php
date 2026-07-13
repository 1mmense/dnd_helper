<button
    {{ $attributes->merge([
        'class' =>
            'my-4 px-4 py-2 bg-black/30 rounded border border-white/30 hover:bg-white/15',
        'type' => 'submit',
    ]) }}
>
    {{ $slot }}
</button>
