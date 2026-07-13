<?php

use App\Helpers\Config;
use App\Models\Creature;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public bool $initiativePopupDisplayFlag = false;

    #[Validate('required|numeric|min:' . Config::DEFAULT_INI)]
    public $initiative;

    public $creatureId = null;

    public function updateInitiative()
    {
        $this->validate();

        if (!isset($this->creatureId, $this->initiative)) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::find($this->creatureId);

        $creature->update([
            'initiative' => $this->initiative,
        ]);

        $this->dispatch('reload-main-content');

        $this->initiativePopupDisplayFlag = false;
    }

    #[On('open-ini-popup')]
    public function showDurationPopup($creatureId = null, $initiative = null)
    {
        if (!isset($creatureId, $initiative)) {
            return;
        }

        $this->initiative = $initiative;
        $this->creatureId = $creatureId;

        $this->initiativePopupDisplayFlag = true;
    }
};
