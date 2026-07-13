<?php

use App\Helpers\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->boolean('is_active')->default(false);
            $table->integer('initiative')->default(Config::DEFAULT_INI);
            $table->integer('position')->default(Config::DEFAULT_POSITION);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
    }
};
