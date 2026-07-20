<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('order')->unique();
            $table->string('title');
            $table->string('client_persona');
            $table->text('scenario_intro');
            $table->unsignedSmallInteger('xp_reward')->default(100);
            $table->boolean('is_gentle_opener')->default(false);
            $table->string('onboarding_entry_key')->nullable();
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
