<?php

namespace App\Enums;

class CreatureColor
{
    public const PLAYER   = 'blue-500';
    public const ALLY     = 'green-500';
    public const ENEMY    = 'red-500';
    public const FALLBACK = 'gray-500';

    /**
     * Возвращает цвет для указанного типа существа
     *
     * @param string $type Тип существа
     *
     * @return string Цвет типа существа
     */
    public static function getColor(string $type): string
    {
        return match ($type) {
            CreatureType::PLAYER => self::PLAYER,
            CreatureType::ALLY   => self::ALLY,
            CreatureType::ENEMY  => self::ENEMY,
            default              => self::FALLBACK,
        };
    }
}
