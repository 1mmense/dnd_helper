<?php

use Illuminate\Support\Collection;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;

new class () extends Component {
    #[Modelable]
    public $selectedItemId = null;

    public $selectedElementKey = null;
    public Collection $items;
    public $label;
    public $open = false;

    #[On('reset-select-element')]
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
