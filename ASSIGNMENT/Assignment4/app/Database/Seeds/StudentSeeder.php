<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'student_id' => 101,
                'name' => 'Deni Prasetyo',
                'study_program' => 'Informatics Engineering',
                'current_semester' => 8,
                'academic_status' => 'Graduated',
                'entry_year' => 2019,
                'gpa' => 3.69,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'student_id' => 102,
                'name' => 'Rina Kartika',
                'study_program' => 'Computer Science',
                'current_semester' => 6,
                'academic_status' => 'On Leave',
                'entry_year' => 2020,
                'gpa' => 3.85,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'student_id' => 103,
                'name' => 'Budi Santoso',
                'study_program' => 'Information Systems',
                'current_semester' => 7,
                'academic_status' => 'Active',
                'entry_year' => 2019,
                'gpa' => 3.45,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'student_id' => 104,
                'name' => 'Siti Rohmah',
                'study_program' => 'Software Engineering',
                'current_semester' => 5,
                'academic_status' => 'On Leave',
                'entry_year' => 2021,
                'gpa' => 3.72,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'student_id' => 105,
                'name' => 'Andi Wijaya',
                'study_program' => 'Data Science',
                'current_semester' => 4,
                'academic_status' => 'Active',
                'entry_year' => 2022,
                'gpa' => 3.90,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'student_id' => 106,
                'name' => 'Lisa Anggraini',
                'study_program' => 'Cyber Security',
                'current_semester' => 3,
                'academic_status' => 'Active',
                'entry_year' => 2022,
                'gpa' => 3.55,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'student_id' => 107,
                'name' => 'Hendra Kusuma',
                'study_program' => 'Artificial Intelligence',
                'current_semester' => 2,
                'academic_status' => 'Active',
                'entry_year' => 2023,
                'gpa' => 3.80,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'student_id' => 108,
                'name' => 'Nina Safitri',
                'study_program' => 'Information Technology',
                'current_semester' => 8,
                'academic_status' => 'Active',
                'entry_year' => 2018,
                'gpa' => 3.95,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'student_id' => 109,
                'name' => 'Wawan Setiawan',
                'study_program' => 'Multimedia',
                'current_semester' => 6,
                'academic_status' => 'Active',
                'entry_year' => 2020,
                'gpa' => 3.67,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'student_id' => 110,
                'name' => 'Farhan Maulana',
                'study_program' => 'Game Development',
                'current_semester' => 7,
                'academic_status' => 'Active',
                'entry_year' => 2019,
                'gpa' => 3.88,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        
        $this->db->table('students')->insertBatch($data);
    }
}