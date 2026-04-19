<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $legacyColumns = array_values(array_filter([
            Schema::hasColumn('habits', 'name') ? 'name' : null,
            Schema::hasColumn('habits', 'description') ? 'description' : null,
            Schema::hasColumn('habits', 'icon') ? 'icon' : null,
            Schema::hasColumn('habits', 'color') ? 'color' : null,
            Schema::hasColumn('habits', 'frequency') ? 'frequency' : null,
            Schema::hasColumn('habits', 'target_per_day') ? 'target_per_day' : null,
            Schema::hasColumn('habits', 'is_active') ? 'is_active' : null,
        ]));

        if ($legacyColumns === []) {
            return;
        }

        Schema::table('habits', function (Blueprint $table) use ($legacyColumns) {
            $table->dropColumn($legacyColumns);
        });
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'name')) {
                $table->string('name')->default('20/20/20 Checklist')->after('notes');
            }

            if (! Schema::hasColumn('habits', 'description')) {
                $table->text('description')->nullable()->after('name');
            }

            if (! Schema::hasColumn('habits', 'icon')) {
                $table->string('icon')->default('heroicon-o-clock')->after('description');
            }

            if (! Schema::hasColumn('habits', 'color')) {
                $table->string('color')->default('#4A7C59')->after('icon');
            }

            if (! Schema::hasColumn('habits', 'frequency')) {
                $table->enum('frequency', ['daily', 'weekly', 'monthly'])->default('daily')->after('color');
            }

            if (! Schema::hasColumn('habits', 'target_per_day')) {
                $table->integer('target_per_day')->default(1)->after('frequency');
            }

            if (! Schema::hasColumn('habits', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('target_per_day');
            }
        });
    }
};
