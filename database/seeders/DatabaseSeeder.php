<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'prefixname' => 'mr',
            'firstname' => 'user',
            'middlename' => NULL,
            'lastname' => 'one',
            'suffixname' => '1',
            'username' => 'user-1',
            'email' => 'user-1@email.com',
            'password' => Hash::make('12345678'),
            'type' => 'user',
        ]);
    }
}
