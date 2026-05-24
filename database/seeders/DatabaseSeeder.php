<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\LabReportSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\TeacherSeeder;
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

        User::factory()->create([
            'name' => 'Ripon',
            'email' => "rmripon166rm@gmail.com",
            'password' => Hash::make('rmripon166rm@gmail.com'),
            'remember_token' => Str::random(10),
            'role' => "admin",
            'phone' => "01979649181",
        ]);

        $this->call([
            StudentSeeder::class,
            TeacherSeeder::class,
            NoticeSeeder::class,
            SubjectSeeder::class,
            AssignmentSeeder::class,
            LabReportSeeder::class,
        ]);
    }
}
