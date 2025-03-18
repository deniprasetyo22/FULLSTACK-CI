<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Enrollment extends BaseController
{
    protected $enrollmentModel;
    protected $studentModel;
    protected $courseModel;

    public function __construct()
    {
        $this->enrollmentModel = new \App\Models\EnrollmentModel();
        $this->studentModel = new \App\Models\StudentModel();
        $this->courseModel = new \App\Models\CourseModel();
    }

    public function index()
    {
        $enrollments = $this->enrollmentModel->getEnrollmentsWithStudentAndCourse()->findAll();

        $data = [
            'page_title' => 'Enrollment List',
            'enrollments' => $enrollments,
            'hideHeader' => true
        ];

        return view('pages/admin/enrollment/v_index', $data);
    }

    public function create()
    {
        $students = array_map(fn($student) => $student->toArray(), $this->studentModel->findAll());
        $courses = array_map(fn($course) => $course->toArray(), $this->courseModel->findAll());
        $semester = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8
        ];
        $status = [
            'Enrolled',
            'Completed'
        ];

        $data = [
            'page_title'  => 'Create Enrollment',
            'students'    => $students,
            'courses'     => $courses,
            'semester'    => $semester,
            'statuses'    => $status,
            'hideHeader'  => true
        ];
        
        return view('pages/admin/enrollment/v_create', $data);
    }

    public function store()
    {
        $enrollment = new \App\Entities\Enrollment($this->request->getPost());

        $rules = $this->enrollmentModel->getValidationRules();
        $messages = $this->enrollmentModel->getValidationMessages();
    
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->enrollmentModel->save($enrollment);

        return redirect()->to('admin/enrollment')->with('message', 'Enrollment added successfully.');
    }

    public function edit($id)
    {
        $enrollment = $this->enrollmentModel->getEnrollmentsWithStudentAndCourse()->find($id);

        if (!$enrollment) {
            return redirect()->to('admin/enrollment')->with('message', 'Enrollment not found');
        }

        $students = array_map(fn($student) => $student->toArray(), $this->studentModel->findAll());
        $courses = array_map(fn($course) => $course->toArray(), $this->courseModel->findAll());
        $semester = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8
        ];
        $status = [
            'Enrolled',
            'Completed'
        ];

        $data = [
            'page_title'  => 'Edit Enrollment',
            'enrollment'  => $enrollment,
            'students'    => $students,
            'courses'     => $courses,
            'semester'    => $semester,
            'statuses'    => $status,
            'hideHeader'  => true
        ];

        return view('pages/admin/enrollment/v_edit', $data);
    }

    public function update($id)
    {
        $enrollment = new \App\Entities\Enrollment($this->request->getPost());
    
        $rules = $this->enrollmentModel->getValidationRules();
        $messages = $this->enrollmentModel->getValidationMessages();
    
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $this->enrollmentModel->update($id, $enrollment);
    
        return redirect()->to('admin/enrollment')->with('message', 'Enrollment updated successfully.');
    }

    public function delete($id)
    {
        $enrollment = $this->enrollmentModel->find($id);
        if (!$enrollment) {
            return redirect()->to('admin/enrollment')->with('message', 'Student not found');
        }

        $this->enrollmentModel->delete($id);

        return redirect()->to('admin/enrollment')->with('message', 'Enrollment deleted successfully');
    }

    public function myEnrollments()
    {
        $student = $this->studentModel->where('user_id', user()->id)->first();

        if (!$student) {
            return redirect()->to('/')->with('message', 'Student data not found.');
        }

        $enrollments = $this->enrollmentModel->getEnrollmentsWithStudentAndCourse()
                            ->where('enrollments.student_id', $student->id)
                            ->findAll();

        $data = [
            'page_title'  => 'My Enrollments',
            'enrollments' => $enrollments,
            'hideHeader'  => true
        ];

        return view('pages/students/v_my_enrollments', $data);
    }

}