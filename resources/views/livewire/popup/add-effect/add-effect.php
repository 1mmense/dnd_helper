<?php

use App\Models\Creature;
use App\Models\Effect;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public bool $effectsPopupDisplayFlag = false;

    public $creatureId = null;
    public $effectId   = null;
    public $effects;

    #[Validate('required|numeric|min:0')]
    public int $duration;

    public function render()
    {
        $this->effects = Effect::all();

        return $this->view([
            'effects' => $this->effects,
        ]);
    }

    #[On('open-effects-popup')]
    public function showEffectsPopup(int $creatureId)
    {
        $this->creatureId = $creatureId;
        // $this->currentEffects = $currentEffects;

        /** @var Creature $creature */
        // $creature = Creature::find($this->creatureId);

        // if (empty($creature)) {
        //     return;
        // }

        // $this->currentEffects = $creature->effects->all() ?? [];

        $this->effectsPopupDisplayFlag = true;
    }

    public function updateEffects()
    {
        $this->validate();

        if (!isset($this->creatureId)) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::find($this->creatureId);

        // $creature->effects()->updateExistingPivotOrFail(
        //     $this->effectId,
        //     ['duration' => $this->duration]
        // );

        // $this->dispatch('duration-updated');

        $this->effectsPopupDisplayFlag = false;
    }
};
