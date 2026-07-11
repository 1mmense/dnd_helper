<div
    x-data="{
        highlighted: 0,
        {{-- open: false, --}}
        count: {{ count($items) }},
        next() {
            this.highlighted = (this.highlighted + 1) % this.count;
        },
        previous() {
            this.highlighted = (this.highlighted + this.count - 1) % this.count;
        },
        select() {
            this.$wire.call('select', this.highlighted);
            this.open = false;
        }
    }"
    x-init="highlighted = {{ $selected ?: 0 }}"
>
    <div class="relative"
        wire:click.outside="$set('open', false)"
    >
        <button
            wire:click="$toggle('open')"
            class="
                w-full flex items-center justify-between h-10 bg-black/20 px-2
                border-white/30
                {{ $open ? 'border-t border-l border-r rounded-t-lg' : 'border rounded-lg' }}
            "
            @keydown.arrow-down="next()"
            @keydown.arrow-up="previous()"
            @keydown.enter.prevent="select()"
        >
            @if ($selected !== null)
                {{ $items[$selected]->name }}
            @else
                {{ $label }}
            @endif

            <div class="text-gray-300">
                @if ($open)
                    <svg class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"/>
                    </svg>
                @endif
            </div>
        </button>

        @if ($open)
            <ul class="
                    bg-red-950 absolute z-10 border border-white/30 w-full max-h-60 overflow-y-auto
                    {{ $open ? 'rounded-b-lg' : 'rounded-lg' }}
                "
            >
                <div class="bg-black/20">
                    @foreach ($items as $item)
                        <li wire:click="select({{ $loop->index }})"
                            @class([
                                'px-3 py-0.5 cursor-pointer flex items-center justify-between',
                                'bg-red-800/70 text-white' => $selected === $loop->index, // Selected option with check mark
                                'hover:bg-red-700 hover:text-white',
                            ])
                            x-data="{ index: {{ $loop->index }} }"
                            :class="index === highlighted ? 'bg-red-700 text-white' : ''"
                            @mouseover="highlighted = index"
                        >
                            {{ $item->name }}

                            {{-- Check mark for the selected option --}}
                            @if ($selected === $loop->index)
                                <div
                                    :class="index === highlighted ? 'text-white' : 'text-red-400'"
                                >
                                    <svg class="h-5 w-5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </div>
            </ul>
        @endif
    </div>
</div>
