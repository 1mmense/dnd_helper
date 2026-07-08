<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Effect extends Model
{
    //

    protected function color(): Attribute
    {
        return Attribute::make(
            get: function (string $value, array $attributes) {
                // $bg  = '300/40';
                // $txt = '300';

                // $formatted = "aria-pressed:bg-{$value}/40 aria-pressed:border-{$value} aria-pressed:text-{$value}";
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
