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
        //
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });

                //
                Schema::create('subscribe', function (Blueprint $table) {
                    $table->id();
                    $table->string('email')->unique();
                    $table->BigInteger("time");
                    $table->timestamps();
                });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
        Schema::dropIfExists('subscribe');
    }
};
