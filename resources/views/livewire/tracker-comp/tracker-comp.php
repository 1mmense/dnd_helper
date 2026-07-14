<?php

use App\Helpers\Config;
use App\Models\Creature;
use App\Models\Effect;
use App\Models\MainList;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

new class () extends Component {
    public Collection $creatures;

    public $effectContainers = [];
    public $effectsList      = [];
    public $roundNumber      = Config::DEFAULT_ROUND_NUMBER;
    public $nextIndex;

    public function render()
    {
        $this->roundNumber = MainList::first()->round_number;
        $this->creatures   = $this->getOrderedCreatures();

        $activeIndex = $this->creatures->search(
            fn ($creature) => $creature->is_active
        );

        if ($activeIndex === false
            && $this->creatures->isNotEmpty()
        ) {
            $this->creatures->first()->update([
                'is_active' => true
            ]);

            $activeIndex = Config::INDEX_FIRST;
        }

        $this->nextIndex = ($activeIndex + 1) % $this->creatures->count();

        $this->creatures = $this->creatures->slice($activeIndex)
            ->merge($this->creatures->take($activeIndex))
            ->values();

        return $this->view([
            'creatures'    => $this->creatures,
            'round_number' => $this->roundNumber,
        ]);
    }

    #[On('reload-main-content')]
    public function refresh()
    {
        // Intentionally empty
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

        $creature->effects()->detach($effectId);
    }

    private function getOrderedCreatures()
    {
        return Creature::
            // with(['effects' => fn ($query) => $query->orderBy('name')])
            with('effects')
            ->orderByDesc('initiative')
            ->get();
    }

    public function nextTurn()
    {
        $this->creatures = $this->getOrderedCreatures();

        if ($this->creatures->isEmpty()) {
            return;
        }

        $currentActiveCreature = $this->creatures->firstWhere('is_active', true);

        if ($currentActiveCreature) {
            $currentActiveCreature->update([
                'is_active' => false
            ]);

            $currentIndex = $this->creatures->search(
                fn ($creature) => $creature->id === $currentActiveCreature->id
            );

            $nextIndex = $this->nextIndex = ($currentIndex + 1) % $this->creatures->count();

            if ($nextIndex === Config::INDEX_FIRST) {
                $this->increaseRoundNumber();
            }

            /** @var Creature $nextCreature */
            $nextCreature = $this->creatures->get($nextIndex);
        } else {
            /** @var Creature $nextCreature */
            $nextCreature = $this->creatures->first();
        }

        $nextCreature->update([
            'is_active' => true
        ]);

        DB::table('creature_effect')
            ->where('creature_id', $currentActiveCreature->id)
            ->where('duration', '>', Config::DURATION_TO_REMOVE)
            ->decrement('duration');

        $currentActiveCreature->effects()
            ->wherePivot('duration', '<=', Config::DURATION_TO_REMOVE)
            ->detach();
    }

    public function resetOrder()
    {
        $this->creatures = $this->getOrderedCreatures();

        if ($this->creatures->isEmpty()) {
            return;
        }

        $currentActiveCreature = $this->creatures->firstWhere('is_active', true);

        if ($currentActiveCreature) {
            $currentActiveCreature->update([
                'is_active' => false
            ]);
        }

        $this->resetRoundNumber();
    }

    public function increaseRoundNumber()
    {
        $mainList = MainList::first();
        $mainList->increment('round_number');
    }

    public function resetRoundNumber()
    {
        $mainList = MainList::first();
        $mainList->update([
            'round_number' => Config::DEFAULT_ROUND_NUMBER
        ]);
    }

    public function destroyCreature($creatureId = null)
    {
        if (!isset($creatureId)) {
            return;
        }

        Creature::find($creatureId)->delete();
    }
};
