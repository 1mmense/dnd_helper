<?php

namespace App\Enums;

use Illuminate\Support\Collection;

class CreatureType
{
    public const PLAYER = 'player';
    public const ALLY   = 'ally';
    public const ENEMY  = 'enemy';

    /**
     * Возвращает название указанного типа существа.
     *
     * @param string $type Тип существа
     *
     * @return string Лейбл типа существа
     */
    public static function getLabel(string $type): string
    {
        return match ($type) {
            self::PLAYER => 'Игрок',
            self::ALLY   => 'Союзник',
            self::ENEMY  => 'Враг',
            default      => 'Неизвестно',
        };
    }

    /**
     * Возвращает все типы существ.
     *
     * @return Collection
     */
    public static function getAll(): Collection
    {
        $rawData = [
            [
                'id'   => self::PLAYER,
                'name' => 'Игрок'
            ],
            [
                'id'   => self::ALLY,
                'name' => 'Союзник'
            ],
            [
                'id'   => self::ENEMY,
                'name' => 'Враг'
            ],
        ];

        return collect($rawData)->map(fn ($item) => (object) $item);
    }
}
