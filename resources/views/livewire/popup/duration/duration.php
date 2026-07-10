<?php

use App\Models\Creature;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class () extends Component {
    public bool $durationPopupDisplayFlag = false;

    #[Validate('required|numeric|min:0')]
    public $duration = null;

    public $creatureId = null;
    public $effectId   = null;

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

        $this->durationPopupDisplayFlag = false;
    }

    #[On('open-duration-popup')]
    public function showDurationPopup($creatureId = null, $effectId = null, $duration = null)
    {
        if (!isset($creatureId, $effectId, $duration)) {
            return;
        }

        $this->duration = $duration;
        $this->creatureId   = $creatureId;
        $this->effectId     = $effectId;

        $this->durationPopupDisplayFlag = true;
    }
};
