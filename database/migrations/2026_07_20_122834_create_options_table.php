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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beat_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('order');
            $table->text('body');
            $table->boolean('is_correct')->default(false);
            $table->text('diagnostic')->nullable();
            $table->foreignId('lesson_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->unique(['beat_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
