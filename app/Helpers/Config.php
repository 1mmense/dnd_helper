<?php

namespace App\Helpers;

use App\Enums\CreatureType;

class Config
{
    public const DURATION_MIN             = 1;
    public const DURATION_TO_REMOVE       = 0;
    public const DEFAULT_INI              = 1;
    public const DEFAULT_POSITION         = 0;
    public const DEFAULT_ROUND_NUMBER     = 1;
    public const INDEX_FIRST              = 0;
    public const CREATURE_NAME_DEFAULT    = 'Существо';
    public const CREATURE_NAME_MIN_LENGTH = 1;
    public const CREATURE_NAME_MAX_LENGTH = 255;
    public const CREATURE_TYPE_DEFAULT    = CreatureType::NON_PLAYABLE;
    public const EFFECT_NAME_DEFAULT      = 'Новый эффект';
    public const EFFECT_NAME_MIN_LENGTH   = 1;
    public const EFFECT_NAME_MAX_LENGTH   = 255;
}
