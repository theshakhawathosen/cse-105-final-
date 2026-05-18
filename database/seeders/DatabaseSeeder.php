<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => "shakhawat9083@gmail.com",
            'password' => Hash::make('shakhawat9083@gmail.com'),
            'remember_token' => Str::random(10),
            'role' => "admin",
            'phone' => "01979649181",
        ]);
    }
}
