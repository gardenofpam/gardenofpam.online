<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'date')) {
                $table->date('date')->nullable()->after('id');
            }

            if (! Schema::hasColumn('habits', 'mind_20')) {
                $table->boolean('mind_20')->default(false)->after('date');
            }

            if (! Schema::hasColumn('habits', 'move_20')) {
                $table->boolean('move_20')->default(false)->after('mind_20');
            }

            if (! Schema::hasColumn('habits', 'grow_20')) {
                $table->boolean('grow_20')->default(false)->after('move_20');
            }

            if (! Schema::hasColumn('habits', 'notes')) {
                $table->text('notes')->nullable()->after('grow_20');
            }
        });

        // Backfill date for existing rows so checklist records stay usable.
        DB::statement('UPDATE habits SET `date` = DATE(created_at) WHERE `date` IS NULL');
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (Schema::hasColumn('habits', 'notes')) {
                $table->dropColumn('notes');
            }

            if (Schema::hasColumn('habits', 'grow_20')) {
                $table->dropColumn('grow_20');
            }

            if (Schema::hasColumn('habits', 'move_20')) {
                $table->dropColumn('move_20');
            }

            if (Schema::hasColumn('habits', 'mind_20')) {
                $table->dropColumn('mind_20');
            }

            if (Schema::hasColumn('habits', 'date')) {
                $table->dropColumn('date');
            }
        });
    }
};
