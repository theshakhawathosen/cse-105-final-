<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = [
            [
                'title' => 'C Programming Basics',
                'description' => 'Write a program to calculate factorial using loop.',
                'subject_id' => 1,
                'deadline' => now()->addDays(7),
                'file' => null,
            ],
            [
                'title' => 'Programming Lab Report',
                'description' => 'Submit all lab task screenshots and source code.',
                'subject_id' => 2,
                'deadline' => now()->addDays(5),
                'file' => null,
            ],
            [
                'title' => 'Linked List Implementation',
                'description' => 'Implement singly linked list with insertion and deletion operations.',
                'subject_id' => 3,
                'deadline' => now()->addDays(10),
                'file' => null,
            ],
            [
                'title' => 'Stack and Queue Lab',
                'description' => 'Perform stack and queue operations using arrays.',
                'subject_id' => 4,
                'deadline' => now()->addDays(6),
                'file' => null,
            ],
            [
                'title' => 'Database ER Diagram',
                'description' => 'Design an ER diagram for a school management system.',
                'subject_id' => 5,
                'deadline' => now()->addDays(8),
                'file' => null,
            ],
            [
                'title' => 'SQL Query Practice',
                'description' => 'Write SQL queries for CRUD operations.',
                'subject_id' => 6,
                'deadline' => now()->addDays(4),
                'file' => null,
            ],
            [
                'title' => 'Network Topology Assignment',
                'description' => 'Explain different types of network topologies.',
                'subject_id' => 7,
                'deadline' => now()->addDays(9),
                'file' => null,
            ],
            [
                'title' => 'Cisco Packet Tracer Lab',
                'description' => 'Create a simple network using Packet Tracer.',
                'subject_id' => 8,
                'deadline' => now()->addDays(12),
                'file' => null,
            ],
            [
                'title' => 'Process Management Report',
                'description' => 'Write a short report on process scheduling algorithms.',
                'subject_id' => 9,
                'deadline' => now()->addDays(7),
                'file' => null,
            ],
            [
                'title' => 'Portfolio Website Project',
                'description' => 'Build a responsive portfolio website using Laravel.',
                'subject_id' => 10,
                'deadline' => now()->addDays(14),
                'file' => null,
            ],
        ];

        $totalAssignments = count($assignments);

        $this->command->getOutput()->progressStart($totalAssignments);

        foreach ($assignments as $assignment) {

            Assignment::create($assignment);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
