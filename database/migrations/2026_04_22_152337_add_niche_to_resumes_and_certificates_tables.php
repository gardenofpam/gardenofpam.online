<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('niche')->default('minapauldata')->after('id');
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->string('niche')->default('minapauldata')->after('id');
        });

        DB::table('resumes')->update(['niche' => 'minapauldata']);
        DB::table('certificates')->update(['niche' => 'minapauldata']);
    }

    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn('niche');
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('niche');
        });
    }
};
