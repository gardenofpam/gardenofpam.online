<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            if (! Schema::hasColumn('resumes', 'resume_file')) {
                $table->string('resume_file')->nullable()->after('version');
            }
        });
    }

    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            if (Schema::hasColumn('resumes', 'resume_file')) {
                $table->dropColumn('resume_file');
            }
        });
    }
};
