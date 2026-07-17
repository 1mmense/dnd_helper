<?php

namespace App\Enums;

class EffectTriggerType
{
    public const ON_CASTER_TURN_START = 'on_caster_turn_start';
    public const ON_CASTER_TURN_END   = 'on_caster_turn_end';
    public const ON_TARGET_TURN_START = 'on_target_turn_start';
    public const ON_TARGET_TURN_END   = 'on_target_turn_end';

    public static function getLabel(string $type): string
    {
        return match ($type) {
            self::ON_TARGET_TURN_END   => 'on_target_turn_end',
            self::ON_TARGET_TURN_START => 'on_target_turn_start',
            self::ON_CASTER_TURN_START => 'on_caster_turn_start',
            self::ON_CASTER_TURN_END   => 'on_caster_turn_end',
        };
    }

    public static function getAll()
    {
        $rawData = [
            [
                'id'   => self::ON_CASTER_TURN_START,
                'name' => 'В начале хода наложившего'
            ],
            [
                'id'   => self::ON_CASTER_TURN_END,
                'name' => 'В конце хода наложившего'
            ],
            [
                'id'   => self::ON_TARGET_TURN_START,
                'name' => 'В начале хода цели'
            ],
            [
                'id'   => self::ON_TARGET_TURN_END,
                'name' => 'В конце хода цели'
            ],
        ];

        return collect($rawData)->map(fn ($item) => (object) $item);
    }
}
