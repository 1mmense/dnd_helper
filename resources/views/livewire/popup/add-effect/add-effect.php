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
    public string $eventTarget     = EventTargets::EFFECT;
    public $effectsList            = null;
    public $creaturesList          = null;
    public $triggerTypesList       = null;
    public bool $refreshSelectFlag = false;
    public $currentEffectId        = null;

    #[Validate('required')]
    public $sourceCreatureId = null;

    #[Validate('required')]
    public $triggerType = null;

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
        $this->currentEffectId  = null;
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
        $this->resetValidation();

        $this->creature         = $creature;
        $this->creaturesList    = Creature::all();
        $this->triggerTypesList = EffectTriggerType::getAll();
        $this->sourceCreatureId = $creature->id;

        if (!isset($effectId, $duration)) {
            return;
        }

        /** @var Effect $effect */
        $effect = $creature->effects()->find($effectId);

        if (empty($effect)) {
            return;
        }

        $this->currentEffectId = $effectId;

        $this->duration         = $duration;
        $this->selectedEffectId = $effect->id;
        $this->sourceCreatureId = $effect->effect_data->source_creature_id;
        $this->triggerType      = $effect->effect_data->trigger_type;
    }

    public function updateEffects()
    {
        $this->validate();

        if (!isset(
            $this->creature,
            $this->selectedEffectId,
            $this->duration,
            $this->triggerType
        )) {
            return;
        }

        if ($this->currentEffectId
            && $this->currentEffectId != $this->selectedEffectId
        ) {
            $oldCreatedDate = $this->creature->effects()->find($this->currentEffectId)->effect_data->created_at ?? null;
            $this->creature->effects()->detach($this->currentEffectId);
        }

        $syncData = [
            $this->selectedEffectId => [
                'trigger_type'       => $this->triggerType,
                'source_creature_id' => $this->sourceCreatureId,
                'duration'           => $this->duration
            ]
        ];

        if (isset($oldCreatedDate)) {
            $syncData[$this->selectedEffectId]['created_at'] = $oldCreatedDate;
        }

        $this->creature->effects()->syncWithoutDetaching($syncData);

        $this->dispatch(EventNames::RELOAD_MAIN_CONTENT);
        $this->dispatch(EventNames::RESET_SELECT_ELEMENT);
        $this->dispatch(EventNames::CLOSE_POPUP, $this->eventTarget);

        $this->resetProperties();
    }
};
