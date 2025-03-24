<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentGradeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'enrollment_id' => 1,
                'grade_value' => 85.50,
                'grade_letter' => 'A',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'enrollment_id' => 2,
                'grade_value' => 78.00,
                'grade_letter' => 'B',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'enrollment_id' => 3,
                'grade_value' => 92.30,
                'grade_letter' => 'A',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'enrollment_id' => 4,
                'grade_value' => 69.40,
                'grade_letter' => 'C',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'enrollment_id' => 5,
                'grade_value' => 80.75,
                'grade_letter' => 'B',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'enrollment_id' => 6,
                'grade_value' => 90.00,
                'grade_letter' => 'A',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'enrollment_id' => 7,
                'grade_value' => 75.60,
                'grade_letter' => 'B',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'enrollment_id' => 8,
                'grade_value' => 88.20,
                'grade_letter' => 'A',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'enrollment_id' => 9,
                'grade_value' => 55.00,
                'grade_letter' => 'D',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'enrollment_id' => 10,
                'grade_value' => 95.50,
                'grade_letter' => 'A',
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert batch data ke dalam tabel student_grades
        $this->db->table('student_grades')->insertBatch($data);
    }
}