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
                'name' => 'Artificial Intelligence',
                'code' => '0613-401',
                'teacher_id' => 1,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Artificial Intelligence Lab',
                'code' => '0613-402',
                'teacher_id' => 2,
                'credit' => 1.0,
                'type' => 'lab',
            ],
            [
                'name' => 'Computer Graphics and Multimedia',
                'code' => '0613-403',
                'teacher_id' => 3,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Computer Graphics and Multimedia Lab',
                'code' => '0613-404',
                'teacher_id' => 4,
                'credit' => 1.0,
                'type' => 'lab',
            ],
            [
                'name' => 'Software Testing and Quality Assurance',
                'code' => '0613-405',
                'teacher_id' => 5,
                'credit' => 1.5,
                'type' => 'theory',
            ],
            [
                'name' => 'Software Testing and Quality Assurance Lab',
                'code' => '0613-406',
                'teacher_id' => 6,
                'credit' => 0.5,
                'type' => 'lab',
            ],
            [
                'name' => 'Mobile Application and Development',
                'code' => '0613-409',
                'teacher_id' => 7,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Mobile Application and Development Lab',
                'code' => '0613-410',
                'teacher_id' => 8,
                'credit' => 1.0,
                'type' => 'lab',
            ],
            [
                'name' => 'Software Integration and Maintenance',
                'code' => '0613-412',
                'teacher_id' => 9,
                'credit' => 3.0,
                'type' => 'theory',
            ],
            [
                'name' => 'Capstone Project Design',
                'code' => '0688-400',
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
