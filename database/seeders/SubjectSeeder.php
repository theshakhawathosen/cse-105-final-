<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Introduction to Programming',
                'code' => 'CSE-101',
                'teacher_id' => 1,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Programming Lab',
                'code' => 'CSE-102',
                'teacher_id' => 2,
                'credit' => 1.5,
                'type' => 'lab',
            ],
            [
                'name' => 'Data Structure',
                'code' => 'CSE-201',
                'teacher_id' => 3,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Data Structure Lab',
                'code' => 'CSE-202',
                'teacher_id' => 4,
                'credit' => 1.5,
                'type' => 'lab',
            ],
            [
                'name' => 'Database Management System',
                'code' => 'CSE-301',
                'teacher_id' => 5,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Database Lab',
                'code' => 'CSE-302',
                'teacher_id' => 6,
                'credit' => 1.5,
                'type' => 'lab',
            ],
            [
                'name' => 'Computer Networks',
                'code' => 'CSE-303',
                'teacher_id' => 7,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Networking Lab',
                'code' => 'CSE-304',
                'teacher_id' => 8,
                'credit' => 1.5,
                'type' => 'lab',
            ],
            [
                'name' => 'Operating System',
                'code' => 'CSE-401',
                'teacher_id' => 9,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Web Engineering',
                'code' => 'CSE-402',
                'teacher_id' => 10,
                'credit' => 3.0,
                'type' => 'theory',
            ],
        ];

        $totalSubjects = count($subjects);

        $this->command->getOutput()->progressStart($totalSubjects);

        foreach ($subjects as $subject) {

            Subject::create($subject);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}


