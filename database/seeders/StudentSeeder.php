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
                'roll' => 1,
                'name' => 'Arafat Hossain',
                'email' => 'arafat.hossain@gmail.com',
                'phone' => '01711000001',
            ],
            [
                'roll' => 2,
                'name' => 'Nusrat Jahan',
                'email' => 'nusrat.jahan@gmail.com',
                'phone' => '01711000002',
            ],
            [
                'roll' => 3,
                'name' => 'Rakib Hasan',
                'email' => 'rakib.hasan@gmail.com',
                'phone' => '01711000003',
            ],
            [
                'roll' => 4,
                'name' => 'Sadia Islam',
                'email' => 'sadia.islam@gmail.com',
                'phone' => '01711000004',
            ],
            [
                'roll' => 5,
                'name' => 'Tanvir Ahmed',
                'email' => 'tanvir.ahmed@gmail.com',
                'phone' => '01711000005',
            ],
            [
                'roll' => 6,
                'name' => 'Mim Akter',
                'email' => 'mim.akter@gmail.com',
                'phone' => '01711000006',
            ],
            [
                'roll' => 7,
                'name' => 'Fahim Rahman',
                'email' => 'fahim.rahman@gmail.com',
                'phone' => '01711000007',
            ],
            [
                'roll' => 8,
                'name' => 'Jannatul Ferdous',
                'email' => 'jannatul.ferdous@gmail.com',
                'phone' => '01711000008',
            ],
            [
                'roll' => 9,
                'name' => 'Shakib Al Hasan',
                'email' => 'shakib.alhasan@gmail.com',
                'phone' => '01711000009',
            ],
            [
                'roll' => 10,
                'name' => 'Tanjina Akter',
                'email' => 'tanjina.akter@gmail.com',
                'phone' => '01711000010',
            ],
            [
                'roll' => 11,
                'name' => 'Mehedi Hasan',
                'email' => 'mehedi.hasan@gmail.com',
                'phone' => '01711000011',
            ],
            [
                'roll' => 12,
                'name' => 'Farzana Yasmin',
                'email' => 'farzana.yasmin@gmail.com',
                'phone' => '01711000012',
            ],
            [
                'roll' => 13,
                'name' => 'Sabbir Ahmed',
                'email' => 'sabbir.ahmed@gmail.com',
                'phone' => '01711000013',
            ],
            [
                'roll' => 14,
                'name' => 'Priya Sultana',
                'email' => 'priya.sultana@gmail.com',
                'phone' => '01711000014',
            ],
            [
                'roll' => 15,
                'name' => 'Mahadi Hasan',
                'email' => 'mahadi.hasan@gmail.com',
                'phone' => '01711000015',
            ],
            [
                'roll' => 16,
                'name' => 'Sumaiya Akter',
                'email' => 'sumaiya.akter@gmail.com',
                'phone' => '01711000016',
            ],
            [
                'roll' => 17,
                'name' => 'Imran Khan',
                'email' => 'imran.khan@gmail.com',
                'phone' => '01711000017',
            ],
            [
                'roll' => 18,
                'name' => 'Tahmina Rahman',
                'email' => 'tahmina.rahman@gmail.com',
                'phone' => '01711000018',
            ],
            [
                'roll' => 19,
                'name' => 'Nayeem Islam',
                'email' => 'nayeem.islam@gmail.com',
                'phone' => '01711000019',
            ],
            [
                'roll' => 20,
                'name' => 'Oishi Chowdhury',
                'email' => 'oishi.chowdhury@gmail.com',
                'phone' => '01711000020',
            ],
        ];

        $this->command->getOutput()->progressStart(count($students));

        foreach ($students as $student) {

            User::create([
                'roll' => $student['roll'],
                'name' => $student['name'],
                'email' => $student['email'],
                'phone' => $student['phone'],
                'reg' => "CS-E-105-22-".time(),
                'photo' => null,
                'role' => 'student',
                'password' => Hash::make('password123'),
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
