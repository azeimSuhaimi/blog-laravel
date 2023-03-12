<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('setting')->insert([
            ['email' => 'abu@gmail.com',
            'description' => '',
            'facebook' => '',
            'twitter' => '',
            'linkedin' => '',
            'youtube' => '',
            'whatsapp' => '',

            ]

        ]);

        DB::table('user')->insert([
            'email' => 'abu22'.'@gmail.com',
            'password' => Hash::make('12345'),
            'name' => 'abu',
            'username' => 'abu',
            'phone' => '014',
            'picture' => 'empty.png',
            'role' => 1,
            'is_active' => true,
            'access' => '*'
        ]);

        DB::table('permissions')->insert([
            ['permission' => 'view dashboard',
            'access' => 'view_dashboard',
            'description' => ''],
            ['permission' => 'open',
            'access' => 'open',
            'description' => '']

        ]);


    }
}
