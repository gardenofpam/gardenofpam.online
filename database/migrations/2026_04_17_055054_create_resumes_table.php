<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('version')->default('1.0');
            $table->json('personal_info');   // name, email, phone, location, summary
            $table->json('education')->nullable();    // array of education entries
            $table->json('experience')->nullable();   // array of work experience
            $table->json('skills')->nullable();       // array of skills
            $table->json('tools')->nullable();        // tools like Python, SQL, Tableau
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};