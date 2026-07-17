<?php

use App\Enums\EventNames;
use App\Enums\EventTargets;
use App\Enums\PopupTitles;
use App\Models\Creature;
use App\Models\Effect;
use Livewire\Attributes\On;
use Livewire\Component;

new class () extends Component {
    public bool $showFlag = false;
    public string $popupTitle;
    public string $eventTarget;

    #[On(EventNames::OPEN_POPUP)]
    public function showPopup(string $eventTarget = '', int $creatureId = 0, int $effectId = 0)
    {
        if (empty($eventTarget)
            || empty($this->eventTarget)
            || $this->eventTarget !== $eventTarget
        ) {
            return;
        }

        $this->showFlag = true;

        $this->popupTitle = match ($this->eventTarget) {
            EventTargets::EFFECT   => $this->getEffectTitle($creatureId, $effectId),
            EventTargets::CREATURE => $this->getCreatureTitle($creatureId),
            default                => PopupTitles::DEFAULT
        };
    }

    private function getEffectTitle(int $creatureId, int $effectId): string
    {
        // TODO: Rework the getCreatureTitle() method and use its functionality here to not repeat the same code.

        $result = PopupTitles::EFFECT;

        /** @var Creature $creature */
        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return $result;
        }

        /** @var Effect $effect */
        $effect = $creature->effects()->find($effectId);

        if (empty($effect)) {
            return $result;
        }

        $result .= " \"{$effect->name}\" ({$creature->name})";

        return $result;
    }

    private function getCreatureTitle(int $creatureId): string
    {
        $result = PopupTitles::CREATURE;

        /** @var Creature $creature */
        $creature = Creature::find($creatureId);

        if (empty($creature)) {
            return $result;
        }

        $result .= " ({$creature->name})";

        return $result;
    }

    #[On(EventNames::CLOSE_POPUP)]
    public function closePopup(string $eventTarget = '')
    {
        $this->showFlag = false;
    }
};
