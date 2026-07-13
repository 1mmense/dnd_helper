<?php

use App\Enums\CreatureType;
use App\Helpers\Config;
use App\Models\Creature;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class () extends Component {
    public bool $creaturePopupDisplayFlag = false;

    #[Validate('required|string|min:' . Config::CREATURE_NAME_MIN_LENGTH . '|max:' . Config::CREATURE_NAME_MAX_LENGTH)]
    public $name = Config::CREATURE_NAME_DEFAULT;

    #[Validate('required|numeric|min:' . Config::DEFAULT_INI)]
    public $initiative = Config::DEFAULT_INI;

    #[Validate('required|string')]
    public $type = null;

    public $typesList;
    public Creature $creature;

    public function resetProperties()
    {
        $this->name       = Config::CREATURE_NAME_DEFAULT;
        $this->initiative = Config::DEFAULT_INI;
        $this->type       = null;
    }

    public function updateCreature()
    {
        $this->validate();

        if (!isset($this->name, $this->initiative, $this->type)) {
            return;
        }

        if ($this->creature) {
            Creature::update([
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

        $this->dispatch('reload-main-content');
        $this->dispatch('reset-select-element');

        $this->resetProperties();

        $this->creaturePopupDisplayFlag = false;
    }

    #[On('open-creature-popup')]
    public function showCreaturePopup($creatureId = null)
    {
        $this->resetProperties();

        if (isset($creatureId)) {
            $this->creature = Creature::find($creatureId);

            if (!empty($this->creature)) {
                $this->name       = $this->creature->name;
                $this->initiative = $this->creature->initiative;
                $this->type       = $this->creature->type;
            }
        }

        $this->typesList                = CreatureType::getAll();
        $this->creaturePopupDisplayFlag = true;
    }
};
