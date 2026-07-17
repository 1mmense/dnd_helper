<?php

use App\Enums\EffectTriggerType;
use App\Enums\EventNames;
use App\Enums\EventTargets;
use App\Helpers\Config;
use App\Models\Creature;
use App\Models\Effect;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public Creature $creature;
    public Effect $effect;
    public string $eventTarget     = EventTargets::EFFECT;
    public $effectsList            = null;
    public $creaturesList          = null;
    public $triggerTypesList       = null;
    public bool $refreshSelectFlag = false;
    public $triggerType            = null;
    public $sourceCreatureId       = null;

    #[Validate('required')]
    public $selectedEffectId = null;

    #[Validate('required|numeric|min:' . Config::DURATION_MIN)]
    public int $duration = Config::DURATION_MIN;

    public function render()
    {
        $this->effectsList = Effect::query()
            ->orderBy('name')
            ->get();

        return $this->view([
            'effects'          => $this->effectsList,
            'creaturesList'    => $this->creaturesList,
            'triggerTypesList' => $this->triggerTypesList,
        ]);
    }

    private function resetProperties()
    {
        $this->selectedEffectId = null;
        $this->triggerType      = null;
        $this->sourceCreatureId = null;
        $this->duration         = Config::DURATION_MIN;
    }

    #[On(EventNames::OPEN_POPUP)]
    public function showEffectsPopup(string $eventTarget, $creatureId = null, $effectId = null, $duration = null)
    {
        if (empty($eventTarget)
            || $eventTarget !== $this->eventTarget
        ) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::findOrFail($creatureId);

        if (empty($creature)) {
            return;
        }

        $this->resetProperties();

        $creaturesList    = Creature::all();
        $triggerTypesList = EffectTriggerType::getAll();

        $this->creature         = $creature;
        $this->creaturesList    = $creaturesList;
        $this->triggerTypesList = $triggerTypesList;
        $this->sourceCreatureId = $creature->id;

        if (!isset($effectId, $duration)) {
            return;
        }

        /** @var Effect $effect */
        $effect = $creature->effects()->find($effectId);

        if (empty($effect)) {
            return;
        }

        $this->duration         = $duration;
        $this->selectedEffectId = $effect->id;
        $this->sourceCreatureId = $effect->effect_data->source_creature_id;
        $this->triggerType      = $effect->effect_data->trigger_type;
    }

    public function updateEffects()
    {
        $this->validate();

        if (!isset($this->creature)
            || !isset($this->selectedEffectId)
            || !isset($this->duration)
            || !isset($this->triggerType)
        ) {
            return;
        }

        $this->creature->effects()->syncWithoutDetaching([
            $this->selectedEffectId => [
                'trigger_type'       => $this->triggerType,
                'source_creature_id' => $this->sourceCreatureId,
                'duration'           => $this->duration
            ]
        ]);

        $this->dispatch(EventNames::RELOAD_MAIN_CONTENT);
        $this->dispatch(EventNames::RESET_SELECT_ELEMENT);
        $this->dispatch(EventNames::CLOSE_POPUP, $this->eventTarget);

        $this->resetProperties();
    }
};
