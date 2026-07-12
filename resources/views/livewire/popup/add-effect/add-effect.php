<?php

use App\Models\Creature;
use App\Models\Effect;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public bool $effectsPopupDisplayFlag = false;

    public Creature $creature;

    public $effectsList      = null;
    public $selectedEffectId = null;

    #[Validate('required|numeric|min:1')]
    public int $duration = 1;

    public bool $refreshSelectFlag = false;

    public function render()
    {
        $this->effectsList = Effect::all();

        return $this->view([
            'effects' => $this->effectsList,
        ]);
    }

    #[On('open-effects-popup')]
    public function showEffectsPopup(int $creatureId)
    {
        /** @var Creature $creature */
        $creature = Creature::findOrFail($creatureId);

        if (empty($creature)) {
            return;
        }

        $this->creature                = $creature;
        $this->effectsPopupDisplayFlag = true;
    }

    public function updateEffects()
    {
        $this->validate();

        if (!isset($this->creature)
            || !isset($this->selectedEffectId)
            || !isset($this->duration)
        ) {
            return;
        }

        $this->creature->effects()->updateExistingPivotOrFail(
            $this->selectedEffectId,
            ['duration' => $this->duration]
        );

        $this->dispatch('reload-main-content');
        $this->dispatch('reset-select-element');

        $this->effectsPopupDisplayFlag = false;
        $this->selectedEffectId        = null;
        $this->duration                = 1;
    }
};
