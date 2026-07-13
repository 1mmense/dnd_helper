@props([
    'for' => null,
])

@if ($for)
    @error($for)
        <p class="mt-1 text-xs font-semibold text-red-500">
            {{ $message }}
        </p>
    @enderror
@endif
