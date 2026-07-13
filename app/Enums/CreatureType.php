<?php

namespace App\Enums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use ReflectionClass;

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

    public static function getAll()
    {
        $rawData = [
            [
                'id'   => self::PLAYABLE,
                'name' => 'Игрок'
            ],
            [
                'id'   => self::NON_PLAYABLE,
                'name' => 'NPC'
            ],
        ];

        return collect($rawData)->map(fn ($item) => (object) $item);
    }
}
