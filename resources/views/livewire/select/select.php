<?php

use Livewire\Component;

new class () extends Component {
    public $items;
    public $selected = null;
    public $label;
    public $open = false;

    // public function toggle()
    // {
    //     $this->open = !$this->open;
    // }

    public function select($index)
    {
        if (!$this->open) {
            return;
        }

        $this->selected = $this->selected !== $index ? $index : null;
        $this->open     = false;
    }
};
