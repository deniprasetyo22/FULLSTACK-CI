<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'code' => 20000001,
                'name' => 'Introduction to Programming',
                'credits' => 3,
                'semester' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'code' => 20000002,
                'name' => 'Database Systems',
                'credits' => 4,
                'semester' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'code' => 20000003,
                'name' => 'Data Structures and Algorithms',
                'credits' => 4,
                'semester' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'code' => 20000004,
                'name' => 'Operating Systems',
                'credits' => 3,
                'semester' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'code' => 20000005,
                'name' => 'Computer Networks',
                'credits' => 3,
                'semester' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'code' => 20000006,
                'name' => 'Artificial Intelligence',
                'credits' => 4,
                'semester' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'code' => 20000007,
                'name' => 'Software Engineering',
                'credits' => 3,
                'semester' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'code' => 20000008,
                'name' => 'Cyber Security',
                'credits' => 3,
                'semester' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'code' => 20000009,
                'name' => 'Mobile Application Development',
                'credits' => 4,
                'semester' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'code' => 20000010,
                'name' => 'Cloud Computing',
                'credits' => 3,
                'semester' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('courses')->insertBatch($data);
    }
}