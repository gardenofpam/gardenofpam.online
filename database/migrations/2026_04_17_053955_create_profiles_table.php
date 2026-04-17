<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('niche')->unique(); // gardenofpam | cpemina | minapauldata
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->longText('bio')->nullable();
            $table->string('photo')->nullable(); // different photo per niche
            $table->json('social_links')->nullable();
            // GardenofPam specific
            $table->json('interests')->nullable();
            $table->json('favorite_movies')->nullable();
            $table->json('favorite_series')->nullable();
            // CPEmina specific
            $table->json('engineering_skills')->nullable();
            // MinaPaulData specific
            $table->json('data_skills')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};