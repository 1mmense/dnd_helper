<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['round_number'])]
#[Table('main_list')]
class MainList extends Model
{
    /** @use HasFactory<\Database\Factories\CreatureFactory> */
    use HasFactory;
}
