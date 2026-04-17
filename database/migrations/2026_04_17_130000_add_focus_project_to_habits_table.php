<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (! Schema::hasColumn('habits', 'focus_project')) {
                $table->string('focus_project')->nullable()->after('ninety_ninety_one_seconds');
            }
        });
    }

    public function down(): void
    {
        Schema::table('habits', function (Blueprint $table) {
            if (Schema::hasColumn('habits', 'focus_project')) {
                $table->dropColumn('focus_project');
            }
        });
    }
};
