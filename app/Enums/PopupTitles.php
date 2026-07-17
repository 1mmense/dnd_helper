<?php

namespace App\Enums;

use ReflectionClass;

class PopupTitles
{
    public const DEFAULT  = 'Название окна';
    public const EFFECT   = 'Эффект';
    public const CREATURE = 'Существо';

    public static function all(): array
    {
        $reflection = new ReflectionClass(self::class);

        return $reflection->getConstants();
    }
}
