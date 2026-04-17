<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'wakeup_time')) {
                $table->time('wakeup_time')->nullable()->after('date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (Schema::hasColumn('habits', 'wakeup_time')) {
                $table->dropColumn('wakeup_time');
            }
        });
    }
};
