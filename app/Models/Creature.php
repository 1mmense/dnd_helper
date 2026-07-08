<?php

namespace App\Models;

use App\Enums\CreatureType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    /** @use HasFactory<\Database\Factories\CreatureFactory> */
    use HasFactory;

    public function effects()
    {
        return $this->belongsToMany(Effect::class, foreignPivotKey: 'creature_id')
            ->as('effect_data')
            ->withPivot('duration');
    }
}
