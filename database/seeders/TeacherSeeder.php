<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Md. Kamrul Hasan',
                'phone' => '01811000001',
                'email' => 'kamrul.hasan@gmail.com',
                'photo' => null,
                'gender' => 'male',
                'roomNumber' => 'A-101',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Sharmin Akter',
                'phone' => '01811000002',
                'email' => 'sharmin.akter@gmail.com',
                'photo' => null,
                'gender' => 'female',
                'roomNumber' => 'A-102',
                'designation' => 'Ass. Professor'
            ],
            [
                'name' => 'Rezaul Karim',
                'phone' => '01811000003',
                'email' => 'rezaul.karim@gmail.com',
                'photo' => null,
                'gender' => 'male',
                'roomNumber' => 'B-201',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Farhana Yasmin',
                'phone' => '01811000004',
                'email' => 'farhana.yasmin@gmail.com',
                'photo' => null,
                'gender' => 'female',
                'roomNumber' => 'B-202',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Jahidul Islam',
                'phone' => '01811000005',
                'email' => 'jahidul.islam@gmail.com',
                'photo' => null,
                'gender' => 'male',
                'roomNumber' => 'C-301',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Nargis Sultana',
                'phone' => '01811000006',
                'email' => 'nargis.sultana@gmail.com',
                'photo' => null,
                'gender' => 'female',
                'roomNumber' => 'C-302',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Mahfuz Rahman',
                'phone' => '01811000007',
                'email' => 'mahfuz.rahman@gmail.com',
                'photo' => null,
                'gender' => 'male',
                'roomNumber' => 'D-401',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Sanjida Rahman',
                'phone' => '01811000008',
                'email' => 'sanjida.rahman@gmail.com',
                'photo' => null,
                'gender' => 'female',
                'roomNumber' => 'D-402',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Tariqul Islam',
                'phone' => '01811000009',
                'email' => 'tariqul.islam@gmail.com',
                'photo' => null,
                'gender' => 'male',
                'roomNumber' => 'E-501',
                'designation' => 'Lecturer'
            ],
            [
                'name' => 'Ayesha Siddika',
                'phone' => '01811000010',
                'email' => 'ayesha.siddika@gmail.com',
                'photo' => null,
                'gender' => 'female',
                'roomNumber' => 'E-502',
                'designation' => 'Lecturer'
            ],
        ];

        $totalTeachers = count($teachers);
        $current = 0;

        $this->command->getOutput()->progressStart($totalTeachers);

        foreach ($teachers as $teacher) {

            Teacher::create($teacher);

            $current++;

            $percentage = round(($current / $totalTeachers) * 100);

            $this->command->getOutput()->progressAdvance();

        }

        $this->command->getOutput()->progressFinish();

    }
}
