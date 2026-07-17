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
    public const CREATURE_ID_DEFAULT      = null;
    public const EFFECT_NAME_DEFAULT      = 'Новый эффект';
    public const EFFECT_NAME_MIN_LENGTH   = 1;
    public const EFFECT_NAME_MAX_LENGTH   = 255;
    public const POPUP_DEFAULT_TITLE      = 'Название окна';

    // Temp
    public const BARBARIAN_ID                  = 3;
    public const RAGE_EFFECT_ID                = 1;
    public const RAGE_EFFECT_DURATION          = 10;
    public const SCHRAT_NAME_TEMPLATE          = 'леший';
    public const SCHRAT_SHIELD_EFFECT_ID       = 2;
    public const SCHRAT_SHIELD_EFFECT_DURATION = 99;
}
