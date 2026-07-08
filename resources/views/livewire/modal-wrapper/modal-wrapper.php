<?php

use App\Models\Creature;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class () extends Component {
    public bool $showEffects  = false;
    public bool $showDuration = false;

    #[Validate('required|numeric|min:0')]
    public $duration = null;

    public $creatureId = null;
    public $effectId   = null;

    public function render()
    {
        return $this->view();
    }

    public function increment()
    {
        if (isset($this->duration)) {
            $this->duration++;
        }
    }

    public function decrement()
    {
        if (isset($this->duration) && $this->duration > 0) {
            $this->duration--;
        }
    }

    public function updateDuration()
    {
        $this->validate();

        if (!isset($this->creatureId, $this->effectId)) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::find($this->creatureId);

        $creature->effects()->updateExistingPivotOrFail(
            $this->effectId,
            ['duration' => $this->duration]
        );

        $this->dispatch('duration-updated');

        $this->showDuration = false;
    }

    #[On('open-duration')]
    public function openDuration($creatureId = null, $effectId = null, $duration = null)
    {
        $this->duration   = $duration;
        $this->creatureId = $creatureId;
        $this->effectId   = $effectId;

        $this->showDuration = true;
    }
};
