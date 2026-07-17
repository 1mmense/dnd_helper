<?php

use App\Enums\EventNames;
use App\Enums\EventTargets;
use App\Helpers\Config;
use App\Models\Creature;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

// TO BE REMOVED
new class () extends Component {
    public $eventTarget = EventTargets::EFFECT;
    public $creatureId  = null;
    public $effectId    = null;

    #[Validate('required|numeric|min:' . Config::DURATION_MIN)]
    public $duration = Config::DURATION_MIN;

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

        $this->dispatch(EventNames::RELOAD_MAIN_CONTENT);
        $this->dispatch(EventNames::CLOSE_POPUP, $this->eventTarget);
    }

    #[On(EventNames::OPEN_POPUP)]
    public function showDurationPopup(string $eventTarget, $creatureId = null, $effectId = null, $duration = null)
    {
        if ($eventTarget !== $this->eventTarget
            || !isset($creatureId, $effectId, $duration)
        ) {
            return;
        }

        $this->duration   = $duration;
        $this->creatureId = $creatureId;
        $this->effectId   = $effectId;
    }
};
