<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'name' => 'Arafat Hossain',
                'email' => 'arafat.hossain@gmail.com',
                'phone' => '01711000001',
            ],
            [
                'name' => 'Nusrat Jahan',
                'email' => 'nusrat.jahan@gmail.com',
                'phone' => '01711000002',
            ],
            [
                'name' => 'Rakib Hasan',
                'email' => 'rakib.hasan@gmail.com',
                'phone' => '01711000003',
            ],
            [
                'name' => 'Sadia Islam',
                'email' => 'sadia.islam@gmail.com',
                'phone' => '01711000004',
            ],
            [
                'name' => 'Tanvir Ahmed',
                'email' => 'tanvir.ahmed@gmail.com',
                'phone' => '01711000005',
            ],
            [
                'name' => 'Mim Akter',
                'email' => 'mim.akter@gmail.com',
                'phone' => '01711000006',
            ],
            [
                'name' => 'Fahim Rahman',
                'email' => 'fahim.rahman@gmail.com',
                'phone' => '01711000007',
            ],
            [
                'name' => 'Jannatul Ferdous',
                'email' => 'jannatul.ferdous@gmail.com',
                'phone' => '01711000008',
            ],
            [
                'name' => 'Shakib Al Hasan',
                'email' => 'shakib.alhasan@gmail.com',
                'phone' => '01711000009',
            ],
            [
                'name' => 'Tanjina Akter',
                'email' => 'tanjina.akter@gmail.com',
                'phone' => '01711000010',
            ],
            [
                'name' => 'Mehedi Hasan',
                'email' => 'mehedi.hasan@gmail.com',
                'phone' => '01711000011',
            ],
            [
                'name' => 'Farzana Yasmin',
                'email' => 'farzana.yasmin@gmail.com',
                'phone' => '01711000012',
            ],
            [
                'name' => 'Sabbir Ahmed',
                'email' => 'sabbir.ahmed@gmail.com',
                'phone' => '01711000013',
            ],
            [
                'name' => 'Priya Sultana',
                'email' => 'priya.sultana@gmail.com',
                'phone' => '01711000014',
            ],
            [
                'name' => 'Mahadi Hasan',
                'email' => 'mahadi.hasan@gmail.com',
                'phone' => '01711000015',
            ],
            [
                'name' => 'Sumaiya Akter',
                'email' => 'sumaiya.akter@gmail.com',
                'phone' => '01711000016',
            ],
            [
                'name' => 'Imran Khan',
                'email' => 'imran.khan@gmail.com',
                'phone' => '01711000017',
            ],
            [
                'name' => 'Tahmina Rahman',
                'email' => 'tahmina.rahman@gmail.com',
                'phone' => '01711000018',
            ],
            [
                'name' => 'Nayeem Islam',
                'email' => 'nayeem.islam@gmail.com',
                'phone' => '01711000019',
            ],
            [
                'name' => 'Oishi Chowdhury',
                'email' => 'oishi.chowdhury@gmail.com',
                'phone' => '01711000020',
            ],
        ];

        $totalStudents = count($students);
        $current = 0;

        $this->command->getOutput()->progressStart($totalStudents);

        foreach ($students as $student) {

            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'phone' => $student['phone'],
                'photo' => null,
                'role' => 'student',
                'password' => Hash::make('password123'),
            ]);

            $current++;

            $percentage = round(($current / $totalStudents) * 100);

            $this->command->getOutput()->progressAdvance();

        }

        $this->command->getOutput()->progressFinish();

    }
}
