<?php

namespace App\Enums;

class CreatureType
{
    public const PLAYABLE     = 'pc';
    public const NON_PLAYABLE = 'npc';

    public static function getLabel(string $type): string
    {
        return match ($type) {
            self::PLAYABLE     => 'Игрок',
            self::NON_PLAYABLE => 'NPC',
        };
    }
}
