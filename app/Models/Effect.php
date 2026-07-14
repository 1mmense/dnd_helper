<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'color')]
class Effect extends Model
{
    protected function colorString(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $formattedString = "bg-{$attributes['color']}/30 border-{$attributes['color']} text-{$attributes['color']}";

                return $formattedString;
            }
        );
    }

    public function creatures()
    {
        return $this->belongsToMany(Creature::class, foreignPivotKey: 'effect_id')
            ->withTimestamps();
    }
}
