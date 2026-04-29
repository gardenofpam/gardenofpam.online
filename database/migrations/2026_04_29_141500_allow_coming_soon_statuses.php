<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE projects DROP CONSTRAINT IF EXISTS projects_status_check');
        DB::statement("ALTER TABLE projects ADD CONSTRAINT projects_status_check CHECK (status IN ('draft', 'published', 'coming_soon'))");

        DB::statement('ALTER TABLE certificates DROP CONSTRAINT IF EXISTS certificates_status_check');
        DB::statement("ALTER TABLE certificates ADD CONSTRAINT certificates_status_check CHECK (status IN ('draft', 'published', 'coming_soon'))");
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("UPDATE projects SET status = 'draft' WHERE status = 'coming_soon'");
        DB::statement("UPDATE certificates SET status = 'draft' WHERE status = 'coming_soon'");

        DB::statement('ALTER TABLE projects DROP CONSTRAINT IF EXISTS projects_status_check');
        DB::statement("ALTER TABLE projects ADD CONSTRAINT projects_status_check CHECK (status IN ('draft', 'published'))");

        DB::statement('ALTER TABLE certificates DROP CONSTRAINT IF EXISTS certificates_status_check');
        DB::statement("ALTER TABLE certificates ADD CONSTRAINT certificates_status_check CHECK (status IN ('draft', 'published'))");
    }
};
