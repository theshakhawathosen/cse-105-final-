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
                'roll' => 5,
                'name' => 'Shakhawat',
                'email' => 'shakhawat9083@gmail.com',
                'phone' => '01710503837',
            ],
            [
                'roll' => 6,
                'name' => 'Shakhawat Hosen',
                'email' => 'shakhawat90831@gmail.com',
                'phone' => '01301149264',
            ],
            // [
            //     'roll' => 7,
            //     'name' => 'Md. Rumon Ahmed',
            //     'email' => 'rumonahmed563@gmail.com',
            //     'phone' => '01776956453',
            // ],
            // [
            //     'roll' => 11,
            //     'name' => 'Md Rulin Rahman',
            //     'email' => 'contact.rulinrahman@gmail.com',
            //     'phone' => '01644323065',
            // ],
            // [
            //     'roll' => 12,
            //     'name' => 'Jannatul Ferdous',
            //     'email' => 'jannatulferdous20420023@gmail.com',
            //     'phone' => '01720420023',
            // ],
            // [
            //     'roll' => 13,
            //     'name' => 'Mahruful Alam',
            //     'email' => 'mahruf9060@gmail.com',
            //     'phone' => '01881969060',
            // ],
            // [
            //     'roll' => 15,
            //     'name' => 'Md Mehedi Hasan Joy',
            //     'email' => 'mehedi@mehedi.io',
            //     'phone' => '01739605553',
            // ],
            // [
            //     'roll' => 16,
            //     'name' => 'Joy Karmokar',
            //     'email' => 'rajkumer975@gmail.com',
            //     'phone' => '01765859636',
            // ],
            // [
            //     'roll' => 18,
            //     'name' => 'Md. Shariful Islam',
            //     'email' => 'mdsharifulislam9880@gmail.com',
            //     'phone' => '01751449880',
            // ],
            // [
            //     'roll' => 19,
            //     'name' => 'Aklima Akter',
            //     'email' => 'akhia7811@gmail.com',
            //     'phone' => '01637099120',
            // ],
            // [
            //     'roll' => 20,
            //     'name' => 'Md. Mosttakim Billah',
            //     'email' => 'mosttakim01@gmail.com',
            //     'phone' => '01984633775',
            // ],
            // [
            //     'roll' => 21,
            //     'name' => 'Akhi Moni',
            //     'email' => 'missalonaldanga@gmail.com',
            //     'phone' => '01701942670',
            // ],
            // [
            //     'roll' => 22,
            //     'name' => 'Mahmuda Akter',
            //     'email' => 'mahmudamunni84@gmail.com',
            //     'phone' => '01322956912',
            // ],
            // [
            //     'roll' => 23,
            //     'name' => 'Zamil Uddin',
            //     'email' => 'zamilgraphicsdesigner@gmail.com',
            //     'phone' => '01719181239',
            // ],
            // [
            //     'roll' => 24,
            //     'name' => 'Md. Al-Amin',
            //     'email' => 'mdalamin.diu.cse@gmail.com',
            //     'phone' => '01745473151',
            // ],
            // [
            //     'roll' => 25,
            //     'name' => 'Md. Hadaitullah',
            //     'email' => 'hadaitullah808@gmail.com',
            //     'phone' => '01796460002',
            // ],
            // [
            //     'roll' => 26,
            //     'name' => 'Sumi Akter',
            //     'email' => 'sumiakter59664@gmail.com',
            //     'phone' => '01610714131',
            // ],
            // [
            //     'roll' => 27,
            //     'name' => 'Mitua Das',
            //     'email' => 'Mituadas59@gmail.com',
            //     'phone' => '01816045267',
            // ],
            // [
            //     'roll' => 28,
            //     'name' => 'Urmi Dey',
            //     'email' => 'urmidey460@gmail.com',
            //     'phone' => '01621798062',
            // ],
            // [
            //     'roll' => 31,
            //     'name' => 'Md. Jibon Islam Santo',
            //     'email' => 'jisjibonpb07@gmail.com',
            //     'phone' => '01947563737',
            // ],
            // [
            //     'roll' => 32,
            //     'name' => 'Mohammad Mahfuz Hasan Sourav',
            //     'email' => 'mhsourav79@gmail.com',
            //     'phone' => '01724589124',
            // ],
            // [
            //     'roll' => 33,
            //     'name' => 'Mahmudul Hasan',
            //     'email' => 'mridulmh400@gmail.com',
            //     'phone' => '01703041072',
            // ],
            // [
            //     'roll' => 34,
            //     'name' => 'Shakhawat Hosen',
            //     'email' => 'shakhawat9083@gmail.com',
            //     'phone' => '01884897611',
            // ],
            // [
            //     'roll' => 35,
            //     'name' => 'Atiqur Rahman',
            //     'email' => 'atik74734@gmail.com',
            //     'phone' => '01825465820',
            // ],
            // [
            //     'roll' => 36,
            //     'name' => 'Murad Mia',
            //     'email' => 'muradhosain01834@gmail.com',
            //     'phone' => '01834749557',
            // ],
            // [
            //     'roll' => 37,
            //     'name' => 'Shahriar Ahmed',
            //     'email' => 'shahriarshazid0@gmail.com',
            //     'phone' => '01757101864',
            // ],
            // [
            //     'roll' => 39,
            //     'name' => 'Md Abdullah',
            //     'email' => 'abdullah21bd@gmail.com',
            //     'phone' => '01995082091',
            // ],
            // [
            //     'roll' => 41,
            //     'name' => 'MD Shafin Islam',
            //     'email' => 'mdshafinislam183@gmail.com',
            //     'phone' => '01948476917',
            // ],
            // [
            //     'roll' => 42,
            //     'name' => 'Md Mahim Mahmud',
            //     'email' => 'mdmahimmahmud6244@gmail.com',
            //     'phone' => '01948746451',
            // ],
            // [
            //     'roll' => 43,
            //     'name' => 'Md. Abu Nasim',
            //     'email' => 'nasimcse1@gmail.com',
            //     'phone' => '01770167590',
            // ],
            // [
            //     'roll' => 44,
            //     'name' => 'Md. Tarek Ahammed Emran',
            //     'email' => 'emran.ahammed26@gmail.com',
            //     'phone' => '01792446110',
            // ],
            // [
            //     'roll' => 46,
            //     'name' => 'Md Sultan Basunia',
            //     'email' => 'sultanmahamudkpi@gmail.com',
            //     'phone' => '01400703776',
            // ],
        ];

        $this->command->getOutput()->progressStart(count($students));

        foreach ($students as $student) {

            User::create([
                'roll' => $student['roll'],
                'name' => $student['name'],
                'email' => $student['email'],
                'phone' => $student['phone'],
                'reg' => "CS-E-105-22-" . time(),
                'photo' => null,
                'role' => 'student',
                'password' => Hash::make('password123'),
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
