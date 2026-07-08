@props([
    'active' => false,
    'type' => 'a'
])

@if ($type === 'a')
    <a class="{{ $active ? 'bg-white/15 text-white' : 'text-gray-300 hover:bg-white/25 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
        aria-current="{{ $active ? 'page' : 'false' }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </a>
@else
    <button class="{{ $active ? 'bg-white/15 text-white' : 'text-gray-300 hover:bg-white/25 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
        aria-current="{{ $active ? 'page' : 'false' }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
@endif
