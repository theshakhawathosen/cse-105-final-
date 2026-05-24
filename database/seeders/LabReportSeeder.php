<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabReport;

class LabReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labReports = [
            [
                'title' => 'Programming Fundamentals Lab Report',
                'subject_id' => 2,
                'description' => 'Submit all basic C programming lab tasks with output screenshots.',
                'deadline' => now()->addDays(7),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Data Structure Linked List Lab',
                'subject_id' => 4,
                'description' => 'Prepare a report on linked list implementation and operations.',
                'deadline' => now()->addDays(10),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Database SQL Practice Report',
                'subject_id' => 6,
                'description' => 'Submit SQL query screenshots and explanations.',
                'deadline' => now()->addDays(5),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Networking Configuration Lab',
                'subject_id' => 8,
                'description' => 'Configure routers and switches using Packet Tracer.',
                'deadline' => now()->addDays(12),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Operating System Process Simulation',
                'subject_id' => 9,
                'description' => 'Write a report on CPU scheduling simulation.',
                'deadline' => now()->addDays(8),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Web Engineering Laravel CRUD',
                'subject_id' => 10,
                'description' => 'Develop a CRUD application using Laravel framework.',
                'deadline' => now()->addDays(15),
                'file' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Database Normalization Report',
                'subject_id' => 5,
                'description' => 'Explain 1NF, 2NF, and 3NF with examples.',
                'deadline' => now()->subDays(2),
                'file' => null,
                'status' => 'closed',
            ],
            [
                'title' => 'Computer Network IP Addressing',
                'subject_id' => 7,
                'description' => 'Prepare subnetting examples and IP calculation report.',
                'deadline' => now()->subDays(1),
                'file' => null,
                'status' => 'closed',
            ],
        ];

        $totalLabReports = count($labReports);

        $this->command->getOutput()->progressStart($totalLabReports);

        foreach ($labReports as $labReport) {

            LabReport::create($labReport);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}

