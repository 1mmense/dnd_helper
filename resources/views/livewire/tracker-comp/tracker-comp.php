<?php

use App\Enums\EffectTriggerType;
use App\Enums\EventNames;
use App\Helpers\Config;
use App\Models\Creature;
use App\Models\Effect;
use App\Models\MainList;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

new class () extends Component {
    public Collection $creatures;
    public $nextIndex;
    public $effectContainers = [];
    public $effectsList      = [];
    public $roundNumber      = Config::DEFAULT_ROUND_NUMBER;

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
            'event_names'  => EventNames::all()
        ]);
    }

    #[On(EventNames::RELOAD_MAIN_CONTENT)]
    public function refresh()
    {
        // Intentionally empty
    }

    #[On(EventNames::REMOVE_EFFECT)]
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

        /** @var Creature $currentActiveCreature */
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

        $this->processEffects(currentCreature: $currentActiveCreature, nextCreature: $nextCreature);
    }

    public function processEffects(Creature $currentCreature, Creature $nextCreature)
    {
        if (!empty($currentCreature)) {
            DB::table('creature_effect')
                ->where('source_creature_id', $currentCreature->id)
                ->where('trigger_type', EffectTriggerType::ON_CASTER_TURN_END)
                ->where('duration', '>', Config::DURATION_TO_REMOVE)
                ->decrement('duration');

            DB::table('creature_effect')
                ->where('creature_id', $currentCreature->id)
                ->where('trigger_type', EffectTriggerType::ON_TARGET_TURN_END)
                ->where('duration', '>', Config::DURATION_TO_REMOVE)
                ->decrement('duration');

            $currentCreature->effects()
                ->wherePivot('duration', '<=', Config::DURATION_TO_REMOVE)
                ->detach();
        }

        if (!empty($nextCreature)) {
            DB::table('creature_effect')
                ->where('source_creature_id', $nextCreature->id)
                ->where('trigger_type', EffectTriggerType::ON_CASTER_TURN_START)
                ->where('duration', '>', Config::DURATION_TO_REMOVE)
                ->decrement('duration');

            DB::table('creature_effect')
                ->where('creature_id', $nextCreature->id)
                ->where('trigger_type', EffectTriggerType::ON_TARGET_TURN_START)
                ->where('duration', '>', Config::DURATION_TO_REMOVE)
                ->decrement('duration');

            $nextCreature->effects()
                ->wherePivot('duration', '<=', Config::DURATION_TO_REMOVE)
                ->detach();
        }
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

    // TEMP
    public function applyRage($creatureId = null)
    {
        if (!isset($creatureId)) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return;
        }

        $creature->effects()->syncWithoutDetaching([
            Config::RAGE_EFFECT_ID => [
                'trigger_type'       => EffectTriggerType::ON_TARGET_TURN_END,
                'source_creature_id' => $creatureId,
                'duration'           => Config::RAGE_EFFECT_DURATION
            ]
        ]);
    }

    // TEMP
    public function applySchratShield($creatureId = null)
    {
        if (!isset($creatureId)) {
            return;
        }

        /** @var Creature $creature */
        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return;
        }

        $creature->effects()->syncWithoutDetaching([
            Config::SCHRAT_SHIELD_EFFECT_ID => [
                'trigger_type'       => EffectTriggerType::ON_TARGET_TURN_END,
                'source_creature_id' => $creatureId,
                'duration'           => Config::SCHRAT_SHIELD_EFFECT_DURATION
            ]
        ]);
    }
};
