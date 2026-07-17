<?php

namespace App\Enums;

use ReflectionClass;

class EventNames
{
    public const OPEN_POPUP           = 'open_popup';
    public const CLOSE_POPUP          = 'close_popup';
    public const RESET_SELECT_ELEMENT = 'reset_select_element';
    public const REMOVE_EFFECT        = 'remove_effect';
    public const RELOAD_MAIN_CONTENT  = 'reload_main_content';

    public static function all(): array
    {
        $reflection = new ReflectionClass(self::class);

        return $reflection->getConstants();
    }
}
