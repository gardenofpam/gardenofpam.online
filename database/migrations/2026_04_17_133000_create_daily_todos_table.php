<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_todos', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedTinyInteger('item_order');
            $table->string('task')->nullable();
            $table->boolean('is_done')->default(false);
            $table->timestamps();

            $table->unique(['date', 'item_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_todos');
    }
};
