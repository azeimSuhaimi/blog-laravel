<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Posts', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('title')->unique();
            $table->string('category');
            $table->text('content');
            $table->string('editor');
            $table->string('image');
            $table->boolean('pick')->default(false);
            $table->integer('count')->default(0);
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Posts');
    }
};
