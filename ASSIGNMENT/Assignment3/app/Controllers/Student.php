<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function index()
    {
        $parser = \config\Services::parser();

        $data = [
            'page_title' => 'Student List',
            'students' => [
                [
                    'studentId' => 1,
                    'studentName' => 'Deni Prasetyo',
                    'programStudy' => 'Computer Science',
                    'currentSemester' => 4,
                    'gpa' => 3.5,
                    'slug' => 'deni-prasetyo'
                ],
                [
                    'studentId' => 2,
                    'studentName' => 'John Doe',
                    'programStudy' => 'Information Technology',
                    'currentSemester' => 3,
                    'gpa' => 3.8,
                    'slug' => 'john-doe'
                ],
                [
                    'studentId' => 3,
                    'studentName' => 'Bob Smith',
                    'programStudy' => 'Business Administration',
                    'currentSemester' => 2,
                    'gpa' => 3.2,
                    'slug' => 'bob-smith'
                ],
                [
                    'studentId' => 4,
                    'studentName' => 'Alice Johnson',
                    'programStudy' => 'Marketing',
                    'currentSemester' => 1,
                    'gpa' => 3.9,
                    'slug' => 'alice-johnson'
                ],
                [
                    'studentId' => 5,
                    'studentName' => 'Charlie Brown',
                    'programStudy' => 'Psychology',
                    'currentSemester' => 4,
                    'gpa' => 3.7,
                    'slug' => 'charlie-brown'
                ]
            ]
        ];

        $data['content'] = $parser->setData($data)->render('components/studentList', ['cache'=>1800, 'cache_name'=>'studentList']);

        return view('pages/students/v_index', $data);
    }

    public function profile($slug)
    {
        $parser = \config\Services::parser();
        
        $data = [
            [
                'studentId'       => 1,
                'studentName'     => 'Deni Prasetyo',
                'programStudy'    => 'Computer Science',
                'currentSemester' => 4,
                'gpa'             => 3.5,
                'slug'            => 'deni-prasetyo',
                'academic_status' => 'Active',
                'personal_information' => [
                    [
                    'DOB'    => '1995-01-01',
                    'Gender' => 'Male',
                    'Email'  => 'deni@example.com'
                ]],
                'course_enrollments' => [
                    ['course_code' => 'A101', 'course_name' => 'Web Development'],
                    ['course_code' => 'A102', 'course_name' => 'Database Systems'],
                    ['course_code' => 'A103', 'course_name' => 'Algorithms']
                ],
                'latest_course_grades' => [
                    ['course_name' => 'Web Development', 'grade' => 'A'],
                    ['course_name' => 'Database Systems', 'grade' => 'B'],
                    ['course_name' => 'Algorithms', 'grade' => 'B']
                ]
            ],
            [
                'studentId'       => 2,
                'studentName'     => 'John Doe',
                'programStudy'    => 'Information Technology',
                'currentSemester' => 3,
                'gpa'             => 3.8,
                'slug'            => 'john-doe',
                'academic_status' => 'Active',
                'personal_information' => [
                    ['DOB' => '1994-05-12', 'Gender' => 'Male', 'Email'  => 'john@example.com']
                ],
                'course_enrollments' => [
                    ['course_code' => 'A104', 'course_name' => 'Mobile App Development'],
                    ['course_code' => 'A105', 'course_name' => 'Cloud Computing'],
                    ['course_code' => 'A106', 'course_name' => 'Network Security']
                ],
                'latest_course_grades' => [
                    ['course_name' => 'Mobile App Development', 'grade' => 'B'],
                    ['course_name' => 'Cloud Computing', 'grade' => 'A'],
                    ['course_name' => 'Network Security', 'grade' => 'A']
                ]
            ],
            [
                'studentId'       => 3,
                'studentName'     => 'Bob Smith',
                'programStudy'    => 'Business Administration',
                'currentSemester' => 2,
                'gpa'             => 3.2,
                'slug'            => 'bob-smith',
                'academic_status' => 'Active',
                'personal_information' => [
                    ['DOB'    => '1996-08-20', 'Gender' => 'Male', 'Email'  => 'bob@example.com']
                ],
                'course_enrollments' => [
                    ['course_code' => 'A107', 'course_name' => 'Marketing Fundamentals'],
                    ['course_code' => 'A108', 'course_name' => 'Business Communication'],
                    ['course_code' => 'A109', 'course_name' => 'Financial Accounting']
                ],
                'latest_course_grades' => [
                    ['course_name' => 'Marketing Fundamentals', 'grade' => 'B'],
                    ['course_name' => 'Business Communication', 'grade' => 'B'],
                    ['course_name' => 'Financial Accounting', 'grade' => 'B']
                ]
            ],
            [
                'studentId'       => 4,
                'studentName'     => 'Alice Johnson',
                'programStudy'    => 'Marketing',
                'currentSemester' => 1,
                'gpa'             => 3.9,
                'slug'            => 'alice-johnson',
                'academic_status' => 'Active',
                'personal_information' => [
                    ['DOB'    => '1997-11-03', 'Gender' => 'Female', 'Email'  => 'alice@example.com']
                ],
                'course_enrollments' => [
                    ['course_code' => 'A110', 'course_name' => 'Consumer Behavior'],
                    ['course_code' => 'A111', 'course_name' => 'Digital Marketing'],
                    ['course_code' => 'A112', 'course_name' => 'Market Research']
                ],
                'latest_course_grades' => [
                    ['course_name' => 'Consumer Behavior', 'grade' => 'A'],
                    ['course_name' => 'Digital Marketing', 'grade' => 'A'],
                    ['course_name' => 'Market Research', 'grade' => 'A']
                ]
            ],
            [
                'studentId'       => 5,
                'studentName'     => 'Charlie Brown',
                'programStudy'    => 'Psychology',
                'currentSemester' => 4,
                'gpa'             => 3.7,
                'slug'            => 'charlie-brown',
                'academic_status' => 'Active',
                'personal_information' => [
                    ['DOB'    => '1995-03-15', 'Gender' => 'Male', 'Email'  => 'charlie@example.com']
                ],
                'course_enrollments' => [
                    ['course_code' => 'A113', 'course_name' => 'Developmental Psychology'],
                    ['course_code' => 'A114', 'course_name' => 'Cognitive Neuroscience'],
                    ['course_code' => 'A115', 'course_name' => 'Social Psychology']
                ],
                'latest_course_grades' => [
                    ['course_name' => 'Developmental Psychology', 'grade' => 'B'],
                    ['course_name' => 'Cognitive Neuroscience', 'grade' => 'B'],
                    ['course_name' => 'Social Psychology', 'grade' => 'B']
                ]
            ]
        ];

        $student = null;
        foreach ($data as $item) {
            if ($item['slug'] === $slug) {
                $student = $item;
                break;
            }
        }

        $student['academic_status'] = view_cell('AcademicStatusCell', ['academicStatus' => $student['academic_status']]);

        $student['latest_course_grades'] = view_cell('LatestGradesCell', [
            'course' => $student['latest_course_grades'],
            'filter' => true
        ]);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Student with slug '$slug' not found.");
        }

        $data['content'] = $parser->setData($student)->render('components/studentProfile', ['cache' => 86400, 'cache_name' => 'student_profile']);

        return view('pages/students/v_index', $data);
    }
}

?>