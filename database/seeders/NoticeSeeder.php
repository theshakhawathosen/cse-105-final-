<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notice;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notices = [
            [
                'title' => 'Mid Term Exam Schedule Published',
                'content' => 'The mid term examination schedule for all departments has been published. Students are requested to check the notice board regularly.',
                'category' => 'Exam',
                'priority' => 'high',
                'is_published' => true,
                'expire_at' => now()->addDays(15),
                'is_scrolling' => true,
            ],
            [
                'title' => 'Computer Lab Maintenance',
                'content' => 'The computer lab will remain closed on Friday due to maintenance work.',
                'category' => 'Lab',
                'priority' => 'normal',
                'is_published' => true,
                'expire_at' => now()->addDays(5),
                'is_scrolling' => false,
            ],
            [
                'title' => 'Class Suspension Notice',
                'content' => 'All classes will remain suspended next Sunday due to unavoidable circumstances.',
                'category' => 'Academic',
                'priority' => 'urgent',
                'is_published' => true,
                'expire_at' => now()->addDays(2),
                'is_scrolling' => true,
            ],
            [
                'title' => 'Assignment Submission Deadline',
                'content' => 'Students must submit their assignments within the given deadline. Late submissions will not be accepted.',
                'category' => 'Academic',
                'priority' => 'high',
                'is_published' => true,
                'expire_at' => now()->addDays(7),
                'is_scrolling' => false,
            ],
            [
                'title' => 'Library New Arrivals',
                'content' => 'Several new programming and networking books have been added to the library.',
                'category' => 'Library',
                'priority' => 'low',
                'is_published' => true,
                'expire_at' => now()->addDays(30),
                'is_scrolling' => false,
            ],
            [
                'title' => 'Internship Seminar আয়োজন',
                'content' => 'আগামী বুধবার ইন্টার্নশিপ ও ক্যারিয়ার গাইডলাইন বিষয়ক সেমিনার অনুষ্ঠিত হবে।',
                'category' => 'Seminar',
                'priority' => 'normal',
                'is_published' => true,
                'expire_at' => now()->addDays(10),
                'is_scrolling' => true,
            ],
            [
                'title' => 'Eid Vacation Notice',
                'content' => 'Institute will remain closed during Eid holidays from June 5 to June 12.',
                'category' => 'Holiday',
                'priority' => 'high',
                'is_published' => true,
                'expire_at' => now()->addDays(20),
                'is_scrolling' => true,
            ],
            [
                'title' => 'Viva Examination Notice',
                'content' => 'Final year viva examinations will start from next Monday.',
                'category' => 'Exam',
                'priority' => 'urgent',
                'is_published' => true,
                'expire_at' => now()->addDays(6),
                'is_scrolling' => true,
            ],
            [
                'title' => 'Sports Competition Registration',
                'content' => 'Interested students are requested to complete sports registration within this week.',
                'category' => 'Sports',
                'priority' => 'normal',
                'is_published' => true,
                'expire_at' => now()->addDays(8),
                'is_scrolling' => false,
            ],
            [
                'title' => 'Blood Donation Campaign',
                'content' => 'A voluntary blood donation campaign will be held in the campus auditorium.',
                'category' => 'Event',
                'priority' => 'low',
                'is_published' => true,
                'expire_at' => now()->addDays(12),
                'is_scrolling' => false,
            ],
        ];

        $totalNotices = count($notices);

        $this->command->getOutput()->progressStart($totalNotices);

        foreach ($notices as $notice) {

            Notice::create($notice);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
