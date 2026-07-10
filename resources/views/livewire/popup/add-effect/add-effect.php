<?php

use App\Models\Creature;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public bool $effectsPopupDisplayFlag = false;

    public $creatureId     = null;
    public $effectId       = null;

    // TODO: Либо передавать эффекты из вьюшки, либо доставать их один раз где-то здесь
    public $currentEffects = null;

    #[Validate('required|numeric|min:0')]
    public int $duration;

    #[On('open-effects-popup')]
    public function showEffectsPopup(int $creatureId)
    {
        $this->creatureId = $creatureId;
        // $this->currentEffects = $currentEffects;

        /** @var Creature $creature */
        $creature = Creature::find($this->creatureId);

        if (empty($creature)) {
            return;
        }

        $this->currentEffects = $creature->effects->all() ?? [];

        $this->effectsPopupDisplayFlag = true;
    }

    public function updateEffects()
    {
        $this->validate();

        if (!isset($this->creatureId, $this->currentEffects)) {
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
