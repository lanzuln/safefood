<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
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

        User::factory()->create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'email_verified_at'=> now(),
            'password'=> Hash::make(1234),
            'role'=>'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
