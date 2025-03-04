<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'student_id' => 1,
                'course_id' => 1,
                'academic_year' => 2023,
                'semester' => 1,
                'status' => 'Enrolled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'student_id' => 2,
                'course_id' => 2,
                'academic_year' => 2023,
                'semester' => 2,
                'status' => 'Enrolled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'student_id' => 3,
                'course_id' => 3,
                'academic_year' => 2022,
                'semester' => 3,
                'status' => 'Completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'student_id' => 4,
                'course_id' => 4,
                'academic_year' => 2022,
                'semester' => 4,
                'status' => 'Enrolled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'student_id' => 5,
                'course_id' => 5,
                'academic_year' => 2021,
                'semester' => 5,
                'status' => 'Completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'student_id' => 6,
                'course_id' => 6,
                'academic_year' => 2021,
                'semester' => 6,
                'status' => 'Enrolled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'student_id' => 7,
                'course_id' => 7,
                'academic_year' => 2020,
                'semester' => 7,
                'status' => 'Completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'student_id' => 8,
                'course_id' => 8,
                'academic_year' => 2020,
                'semester' => 6,
                'status' => 'Enrolled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'student_id' => 9,
                'course_id' => 9,
                'academic_year' => 2019,
                'semester' => 7,
                'status' => 'Completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'student_id' => 10,
                'course_id' => 10,
                'academic_year' => 2019,
                'semester' => 8,
                'status' => 'Completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('enrollments')->insertBatch($data);
    }
}