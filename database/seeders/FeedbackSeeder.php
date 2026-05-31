<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'user_id' => 1,
                'title' => 'Excellent Lab Environment',
                'description' => 'The programming lab environment is very good and supportive for learning.',
                'file' => null,
            ],
            [
                'user_id' => 2,
                'title' => 'Need More Practical Classes',
                'description' => 'Need more practical classes for database management subjects.',
                'file' => null,
            ],
            // [
            //     'user_id' => 3,
            //     'title' => 'Projector Issue in Classroom',
            //     'description' => 'The classroom projector sometimes does not work properly.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 4,
            //     'title' => 'Friendly and Supportive Teachers',
            //     'description' => 'Teachers are very cooperative and friendly.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 5,
            //     'title' => 'Improve Internet Speed',
            //     'description' => 'Internet speed in the lab should be improved.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 6,
            //     'title' => 'Need Updated Library Books',
            //     'description' => 'Need more updated books in the library section.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 7,
            //     'title' => 'Routine Upload Timing',
            //     'description' => 'Class routine should be uploaded earlier every semester.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 8,
            //     'title' => 'Clean Campus Environment',
            //     'description' => 'The campus environment is clean and সুন্দর.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 9,
            //     'title' => 'Arrange More Programming Contests',
            //     'description' => 'More programming contests should be arranged.',
            //     'file' => null,
            // ],
            // [
            //     'user_id' => 10,
            //     'title' => 'Lab Maintenance Improvement',
            //     'description' => 'Lab equipment maintenance needs improvement.',
            //     'file' => null,
            // ],
        ];

        $totalFeedbacks = count($feedbacks);

        $this->command->getOutput()->progressStart($totalFeedbacks);

        foreach ($feedbacks as $feedback) {

            Feedback::create($feedback);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
