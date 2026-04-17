<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('from_niche');        // which page sent the message
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('subject');
            $table->text('body');
            $table->string('verification_token')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};