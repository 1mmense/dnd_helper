<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bestiary_templates', function (Blueprint $table) {
            $table->id();
            $table->integer('str')->unsigned()->default(10);
            $table->integer('str_range')->unsigned()->default(0);
            $table->integer('agi')->unsigned()->default(10);
            $table->integer('agi_range')->unsigned()->default(0);
            $table->integer('con')->unsigned()->default(10);
            $table->integer('con_range')->unsigned()->default(0);
            $table->integer('int')->unsigned()->default(10);
            $table->integer('int_range')->unsigned()->default(0);
            $table->integer('wis')->unsigned()->default(10);
            $table->integer('wis_range')->unsigned()->default(0);
            $table->integer('cha')->unsigned()->default(10);
            $table->integer('cha_range')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bestiary_templates');
    }
};
