<?php

use App\Models\Creature;
use App\Models\Effect;
use Livewire\Attributes\On;
use Livewire\Component;

new class () extends Component {
    public $creatures;
    public $effectContainers = [];

    public function render()
    {
        $this->creatures = Creature::all();

        return $this->view([
            'creatures' => $this->creatures,
        ]);
    }

    #[On('reload-main-content')]
    public function refresh()
    {
        // Intentionally empty
    }

    public function toggleEffectContainer(string $containerId)
    {
        if (isset($this->effectContainers[$containerId])) {
            unset($this->effectContainers[$containerId]);
        } else {
            $this->effectContainers[$containerId] = true;
        }
    }

    public function toggleEffect(int $creatureId, int $effectId)
    {
        if (empty($creatureId) || empty($effectId)) {
            return;
        }

        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return;
        }

        if ($creature->effects->find($effectId)) {
            $creature->effects()->detach($effectId);
        } else {
            $creature->effects()->attach($effectId);
        }
    }

    #[On('remove-effect')]
    public function removeEffect(int $creatureId, int $effectId)
    {
        /** @var Creature $creature */
        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return;
        }

        /** @var Effect $effect */
        $effect = $creature->effects()->find($effectId);

        if (empty($effect)) {
            return;
        }

        $effect->delete();
    }
};
