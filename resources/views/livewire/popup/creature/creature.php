<?php

use App\Enums\CreatureType;
use App\Enums\EventNames;
use App\Enums\EventTargets;
use App\Helpers\Config;
use App\Models\Creature;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public $typesList;
    public Creature $creature;
    public $creatureId  = Config::CREATURE_ID_DEFAULT;
    public $eventTarget = EventTargets::CREATURE;

    #[Validate('required|string|min:' . Config::CREATURE_NAME_MIN_LENGTH . '|max:' . Config::CREATURE_NAME_MAX_LENGTH)]
    public $name = Config::CREATURE_NAME_DEFAULT;

    #[Validate('required|numeric|min:' . Config::DEFAULT_INI)]
    public $initiative = Config::DEFAULT_INI;

    #[Validate('required|string')]
    public $type = Config::CREATURE_TYPE_DEFAULT;

    private function resetProperties()
    {
        $this->name       = null;
        $this->initiative = Config::DEFAULT_INI;
        $this->type       = Config::CREATURE_TYPE_DEFAULT;
        $this->creatureId = Config::CREATURE_ID_DEFAULT;
    }

    public function updateCreature()
    {
        $this->validate();

        if (!isset($this->name, $this->initiative, $this->type)) {
            return;
        }

        if (isset($this->creature, $this->creatureId)) {
            $this->creature->update([
                'name'       => $this->name,
                'initiative' => $this->initiative,
                'type'       => $this->type,
            ]);
        } else {
            Creature::create([
                'name'       => $this->name,
                'initiative' => $this->initiative,
                'type'       => $this->type,
            ]);
        }

        $this->dispatch(EventNames::RELOAD_MAIN_CONTENT);
        $this->dispatch(EventNames::RESET_SELECT_ELEMENT);
        $this->dispatch(EventNames::CLOSE_POPUP, $this->eventTarget);

        $this->resetProperties();
    }

    #[On(EventNames::OPEN_POPUP)]
    public function showCreaturePopup($creatureId = null)
    {
        $this->resetProperties();

        if (isset($creatureId)) {
            $this->creature = Creature::find($creatureId);

            if (!empty($this->creature)) {
                $this->name       = $this->creature->name;
                $this->initiative = $this->creature->initiative;
                $this->type       = $this->creature->type;
                $this->creatureId = $creatureId;
            }
        }

        $this->typesList = CreatureType::getAll();
    }
};
