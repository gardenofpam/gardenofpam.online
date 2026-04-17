<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'wind_workout')) {
                $table->boolean('wind_workout')->default(false)->after('focus_project');
            }
        });
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (Schema::hasColumn('habits', 'wind_workout')) {
                $table->dropColumn('wind_workout');
            }
        });
    }
};
