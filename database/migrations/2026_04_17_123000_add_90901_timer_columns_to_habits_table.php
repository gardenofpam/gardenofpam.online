<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'ninety_ninety_one_seconds')) {
                $table->unsignedInteger('ninety_ninety_one_seconds')->default(0)->after('grow_20');
            }

            if (! Schema::hasColumn('habits', 'focus_timer_started_at')) {
                $table->timestamp('focus_timer_started_at')->nullable()->after('ninety_ninety_one_seconds');
            }
        });
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (Schema::hasColumn('habits', 'focus_timer_started_at')) {
                $table->dropColumn('focus_timer_started_at');
            }

            if (Schema::hasColumn('habits', 'ninety_ninety_one_seconds')) {
                $table->dropColumn('ninety_ninety_one_seconds');
            }
        });
    }
};
