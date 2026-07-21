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
        Schema::table('user_task_progress', function (Blueprint $table) {
            $table->text('reflection_note')->nullable()->after('passed_at');
            $table->timestamp('reflected_at')->nullable()->after('reflection_note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_task_progress', function (Blueprint $table) {
            $table->dropColumn(['reflection_note', 'reflected_at']);
        });
    }
};
