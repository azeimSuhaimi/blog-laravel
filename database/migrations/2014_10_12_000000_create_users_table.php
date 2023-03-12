<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\user;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('permission')->unique();
            $table->string('access')->unique();
            $table->string('description')->nullable();
            $table->timestamps();

        });
        Schema::create('user', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique()->primary('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('picture');
            $table->boolean('is_active')->default(false);
            $table->integer('role');
            $table->text('access');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('activity_log', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('username');
            $table->string('action');
            $table->timestamps();

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (user::all() as $u) {
           // echo $flight->name;
            if($u->picture != 'empty.png')
            {
                
                $filePath = public_path('assets/profiles/'.$u->picture);
    
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
    
            }
        }//end foreach


        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('user');
        Schema::dropIfExists('permissions');
    }
};
