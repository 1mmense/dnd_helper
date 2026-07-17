<?php

use App\Helpers\Config;
use App\Models\Creature;
use App\Models\Effect;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('effects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('default_duration')->unsigned()->nullable();
            $table->string('color');
            $table->timestamps();
        });

        Schema::create('creature_effect', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Effect::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Creature::class)->constrained()->cascadeOnDelete();
            $table->integer('duration')->unsigned()->default(Config::DURATION_MIN);
            $table->string('trigger_type');
            $table->integer('source_creature_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('main_list', function (Blueprint $table) {
            $table->id();
            $table->integer('round_number')->unsigned()->default(Config::DEFAULT_ROUND_NUMBER);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('effects');
        Schema::dropIfExists('creature_effect');
    }
};
