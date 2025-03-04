<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;

class Course extends BaseController
{
    protected $courseModel;
    protected $session;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->session = \Config\Services::session();
    }
    
    public function index()
    {
        //
    }

    public function courseList()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->findAll();

        $data = [
            'page_title' => 'Course List',
            'courses'    => $courses,
            'hideHeader' => true,
        ];
        
        return view('pages/admin/course/v_courseList', $data);
    }

    public function courseDetail($id)
    {
        $courseModel = new CourseModel();
        $course = $courseModel->find($id);

        if (!$course) {
            return redirect()->to('course-list')->with('message', 'Course not found');
        }

        $data = [
            'page_title' => 'Course Detail',
            'course'    => $course,
            'hideHeader' => true,
        ];
        
        return view('pages/admin/course/v_detailCourse', $data);
    }

    public function createCourse()
    {
        $data = [
            'page_title' => 'Create Course',
            'hideHeader' => true,
        ];
        return view('pages/admin/course/v_createCourse', $data);
    }

    public function storeCourse()
    {
        $course = new \App\Entities\Course($this->request->getPost());

        $rules = $this->courseModel->getValidationRules();
        $messages = $this->courseModel->getValidationMessages();

        $rules['code'] = "required|is_unique[courses.code]|exact_length[8]";

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->courseModel->save($course);

        return redirect()->to('course-list')->with('message', 'Course created successfully');
    }

    public function deleteCourse($id)
    {
        $courseModel = new CourseModel();
        
        $course = $courseModel->find($id);
        if (!$course) {
            return redirect()->to('course-list')->with('message', 'Course not found');
        }

        $courseModel->delete($id);

        return redirect()->to('course-list')->with('message', 'Course deleted successfully');
    }

    public function editCourse($id)
    {
        $courseModel = new CourseModel();
        $course = $courseModel->find($id);

        if (!$course) {
            return redirect()->to('course-list')->with('message', 'Course not found');
        }

        $data = [
            'page_title' => 'Edit Course',
            'course'    => $course,
            'hideHeader' => true,
        ];

        return view('pages/admin/course/v_editCourse', $data);
    }

    public function updateCourse($id)
    {
        $course = new \App\Entities\Course($this->request->getPost());

        $rules = $this->courseModel->getValidationRules();
        $messages = $this->courseModel->getValidationMessages();

        $rules['code'] = "required|is_unique[courses.code,id,{$id}]|exact_length[8]";

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->courseModel->update($id, $course);

        return redirect()->to('course-list')->with('message', 'Course updated successfully');
    }

}