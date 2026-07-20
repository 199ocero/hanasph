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
        Schema::table('beats', function (Blueprint $table) {
            $table->text('tagalog_tip')->nullable()->after('scaffold_hint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beats', function (Blueprint $table) {
            $table->dropColumn('tagalog_tip');
        });
    }
};
