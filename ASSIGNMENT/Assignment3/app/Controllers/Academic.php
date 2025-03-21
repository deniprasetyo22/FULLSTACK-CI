<?php

namespace App\Controllers;

class Academic extends BaseController
{
    public function index()
    {
        return view('pages/admin/v_dashboard', ['hideHeader'=>true]);
    }

    public function studentList()
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

        $data['hideHeader'] = true;
        
        return view('pages/admin/v_studentList', $data);
    }

    public function studentProfile($slug)
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
                ]
            ]
        ];

        // Cari data student berdasarkan slug
        $student = null;
        foreach ($data as $item) {
            if ($item['slug'] === $slug) {
                $student = $item;
                break;
            }
        }
        
        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Student with slug '$slug' not found.");
        }

        $student['academic_status'] = view_cell('AcademicStatusCell', ['academicStatus' => $student['academic_status']]);

        $data['content'] = $parser->setData($student)->render('components/studentProfile', ['cache' => 86400, 'cache_name' => 'student_profile']);
        
        return view('pages/admin/v_studentProfile', $data);
    }

    public function courseList()
    {
        $parser = \config\Services::parser();

        $courses = [
            ['course_code' => 'A101', 'course_name' => 'Web Development'],
            ['course_code' => 'A102', 'course_name' => 'Database Systems'],
            ['course_code' => 'A103', 'course_name' => 'Algorithms'],
            ['course_code' => 'A104', 'course_name' => 'Mobile App Development'],
            ['course_code' => 'A105', 'course_name' => 'Cloud Computing'],
            ['course_code' => 'A106', 'course_name' => 'Network Security'],
            ['course_code' => 'A107', 'course_name' => 'Marketing Fundamentals'],
            ['course_code' => 'A108', 'course_name' => 'Business Communication'],
            ['course_code' => 'A109', 'course_name' => 'Financial Accounting'],
            ['course_code' => 'A110', 'course_name' => 'Consumer Behavior'],
            ['course_code' => 'A111', 'course_name' => 'Digital Marketing'],
            ['course_code' => 'A112', 'course_name' => 'Market Research'],
            ['course_code' => 'A113', 'course_name' => 'Developmental Psychology'],
            ['course_code' => 'A114', 'course_name' => 'Cognitive Neuroscience'],
            ['course_code' => 'A115', 'course_name' => 'Social Psychology']
        ];
    
        $data = [
            'page_title' => 'Course List',
            'content'    => $courses
        ];

        $data['content'] = $parser
        ->setData($data)
        ->render('components/courseList', ['cache' => 84600, 'cache_name' => 'course_list']);

        $data['hideHeader'] = true;
        
        return view('pages/admin/v_courseList', $data);
    }
}

?>