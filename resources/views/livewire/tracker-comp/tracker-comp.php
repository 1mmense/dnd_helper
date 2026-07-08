<?php

use App\Models\Creature;
use App\Models\Effect;
use Livewire\Component;

new class () extends Component {
    public $effectContainers      = [];
    public $showModal             = false;
    // public $showModalAddEffect    = false;
    public $showModalEditDuration = false;

    public function render()
    {
        $creatures = Creature::all();
        $effects   = Effect::all();

        return $this->view([
            'creatures' => $creatures,
            'effects'   => $effects,
        ]);
    }

    // public function openSettingsWithCheck()
    // {
    //     $this->dispatch('open-settings');
    // }

    public function toggleEffectContainer(string $containerId)
    {
        if (isset($this->effectContainers[$containerId])) {
            unset($this->effectContainers[$containerId]);
        } else {
            $this->effectContainers[$containerId] = true;
        }
    }

    public function changeConditionStatus(int $creatureId, int $effectId)
    {
        $creature = Creature::find($creatureId);
        $effect   = Effect::find($effectId);

        if (empty($creature) || empty($effectId)) {
            return;
        }

        if ($creature->effects->find($effectId)) {
            $creature->effects()->detach($effectId);
        } else {
            $creature->effects()->attach($effectId);
        }
    }
};
