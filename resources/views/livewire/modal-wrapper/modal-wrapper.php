<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class () extends Component {
    public bool $showEffects = false;
    public bool $showDuration  = false;

    public $duration = null;

    public function render()
    {
        return $this->view();
    }

    #[On('open-duration')]
    public function openDuration($duration = null)
    {
        $this->duration = $duration;
        $this->showDuration = true;
    }
};
