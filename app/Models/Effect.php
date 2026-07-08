<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Effect extends Model
{
    protected function color(): Attribute
    {
        return Attribute::make(
            get: function (string $value, array $attributes) {
                $formatted = "bg-{$value}/40 border-{$value} text-{$value}";

                return $formatted;
            }
        );
    }

    public function creatures()
    {
        return $this->belongsToMany(Creature::class, foreignPivotKey: 'effect_id');
    }
}
