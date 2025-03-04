<?php

namespace App\Controllers;

use App\Libraries\DataParams;
use App\Models\StudentModel;

class Student extends BaseController
{
    protected $studentModel;
    protected $session;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->session = \Config\Services::session();
    }

    /* Public */
    public function index()
    {
        $parser = \config\Services::parser();

        $studentModel = new StudentModel();
        $students = $studentModel->asArray()->findAll();

        $formattedStudents = array_map(function($student) {
            return [
                'id'              => $student['id'],
                'studentId'       => $student['student_id'],
                'studentName'     => $student['name'],
                'studyProgram'    => $student['study_program'],
                'currentSemester' => $student['current_semester'],
                'academicStatus'  => $student['academic_status'],
                'entryYear'       => $student['entry_year'],
                'gpa'             => $student['gpa'],
                'createdAt'       => $student['created_at'],
                'updatedAt'       => $student['updated_at'],
                'slug'            => strtolower(str_replace(' ', '-', $student['name'])),
            ];
        }, $students);
        
    
        $data = [
            'page_title' => 'Student List',
            'students'   => $formattedStudents,
            'base_url'   => base_url()
        ];

        $data['content'] = $parser->setData($data)->render('components/studentList');

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


    /* Admin */
    public function studentList()
    {
        // $studentModel = new StudentModel();
        // $students = $studentModel->findAll();
    
        // $data = [
        //     'page_title' => 'Student List',
        //     'students'   => $this->studentModel->paginate(3, 'students'),
        //     'pager'      => $this->studentModel->pager,
        //     'hideHeader' => true
        // ];
        
        // return view('pages/admin/student/v_studentList', $data);

        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'study_program' => $this->request->getGet('study_program'),
            'academic_status'=> $this->request->getGet('academic_status'),
            'entry_year'=> $this->request->getGet('entry_year'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page_students' => $this->request->getGet('page_students'),
            'perPage' => $this->request->getGet('perPage'),
        ]);

        // dd($params);    

        $results = $this->studentModel->getFilteredUsers($params);


        $data = [
            'page_title' => 'Student List',
            'students' => $results['students'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'academic_status' => $this->studentModel->getAllAcademicStatus(),
            'study_program' => $this->studentModel->getAllStudyProgram(),
            'entry_year' => $this->studentModel->getAllEntryYear(),
            'baseUrl' => base_url('student-list'),
            'hideHeader' => true
        ];


        return view('pages/admin/student/v_studentList', $data);
    }

    public function studentProfile($slug)
    {
        $parser = \config\Services::parser();
        
        $students = $this->studentModel->asArray()->findAll();

        $student = null;
        foreach ($students as $s) {
            if (strtolower(str_replace(' ', '-', $s['name'])) === $slug) {
                $student = $s;
                break;
            }
        }

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Student with slug '$slug' not found.");
        }

        $student['academic_status'] = view_cell('AcademicStatusCell', ['academicStatus' => $student['academic_status']]);

        $data = [
            'page_title' => 'Student Profile',
            'student'    => $student,
            'hideHeader' => true
        ];

        $data['content'] = $parser->setData($student)->render('components/studentProfile');
        
        return view('pages/admin/student/v_studentProfile', $data);
    }

    public function createStudent()
    {
        $data = [
            'page_title' => 'Create Student',
            'hideHeader' => true,
            'academic_status' => [
                'Active', 'On Leave', 'Graduated'
            ]
        ];
        return view('pages/admin/student/v_createStudent', $data);
    }

    public function storeStudent()
    {
        $student = new \App\Entities\Student($this->request->getPost());

        $rules = $this->studentModel->getValidationRules();
        $messages = $this->studentModel->getValidationMessages();

        $rules['student_id'] = "required|is_unique[students.student_id]";
    
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->studentModel->save($student);

        return redirect()->to('student-list')->with('message', 'Student added successfully.');
    }

    public function deleteStudent($id)
    {
        $studentModel = new StudentModel();
        
        $student = $studentModel->find($id);
        if (!$student) {
            return redirect()->to('student-list')->with('message', 'Student not found');
        }

        $studentModel->delete($id);

        return redirect()->to('student-list')->with('message', 'Student deleted successfully');
    }

    public function editStudent($id)
    {
        $student = $this->studentModel->find($id);

        if (!$student) {
            return redirect()->to('student-list')->with('message', 'Student not found');
        }

        $data = [
            'page_title' => 'Edit Student',
            'student'    => $student->toArray(),
            'hideHeader' => true,
            'academic_status' => ['Active', 'On Leave', 'Graduated']
        ];

        return view('pages/admin/student/v_editStudent', $data);
    }

    public function updateStudent($id)
    {
        $student = new \App\Entities\Student($this->request->getPost());
    
        $rules = $this->studentModel->getValidationRules();
        $messages = $this->studentModel->getValidationMessages();
    
        $rules['student_id'] = "required|is_unique[students.student_id,id,{$id}]";
    
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $this->studentModel->update($id, $student);
    
        return redirect()->to('student-list')->with('message', 'Student updated successfully.');
    }
}

?>