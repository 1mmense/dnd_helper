<?php

use App\Enums\EventNames;
use Illuminate\Support\Collection;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

new class () extends Component {
    public Collection $items;
    public $label;
    public $selectedElementKey = null;
    public $open               = false;

    #[Modelable]
    public $selectedItemId = null;

    public function mount()
    {
        if (!isset($this->selectedElementKey)
            && isset($this->selectedItemId, $this->items)
        ) {
            $this->selectedElementKey = $this->items->search(
                fn ($item) => $item->id === $this->selectedItemId
            );
        }
    }

    #[On(EventNames::RESET_SELECT_ELEMENT)]
    public function unload()
    {
        $this->selectedElementKey = null;
    }

    public function select($selectedElementKey)
    {
        if (!$this->open
            || !isset($selectedElementKey)
        ) {
            return;
        }

        $this->selectedElementKey = $selectedElementKey;

        /** @var Model $item */
        $item = $this->items[$this->selectedElementKey] ?? null;

        if (empty($item)) {
            return;
        }

        $this->selectedItemId = $item->id;
        $this->open           = false;
    }
};
