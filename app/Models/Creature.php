<?php

namespace App\Models;

use App\Enums\CreatureColor;
use App\Enums\CreatureType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['initiative', 'position', 'name', 'is_active', 'type'])]
class Creature extends Model
{
    /** @use HasFactory<\Database\Factories\CreatureFactory> */
    use HasFactory;

    /**
     * Получение всех эффектов, примененных к существу.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function effects()
    {
        return $this->belongsToMany(Effect::class, foreignPivotKey: 'creature_id')
            ->as('effect_data')
            ->withPivot(['duration', 'trigger_type', 'source_creature_id'])
            ->withTimestamps();
    }

    /**
     * Проверка, является ли существо активным, т. е. его ли сейчас ход.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active ?? false;
    }

    /**
     * Проверка, является ли существо игроком.
     *
     * @return bool
     */
    public function isPlayer(): bool
    {
        return $this->type === CreatureType::PLAYER;
    }

    /**
     * Проверка, является ли существо союзником.
     *
     * @return bool
     */
    public function isAlly(): bool
    {
        return $this->type === CreatureType::ALLY;
    }

    /**
     * Проверка, является ли существо врагом.
     *
     * @return bool
     */
    public function isEnemy(): bool
    {
        return $this->type === CreatureType::ENEMY;
    }

    /**
     * Получает цвет фракции существа на основе его типа.
     *
     * @return string
     */
    public function getFactionColorAttribute()
    {
        return CreatureColor::getColor($this->type);
    }
}


