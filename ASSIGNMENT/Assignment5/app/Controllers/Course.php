<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\DataParams;
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
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'credits' => $this->request->getGet('credits'),
            'semester' => $this->request->getGet('semester'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_courses'),
            'perPage' => $this->request->getGet('perPage'),
        ]);

        $results = $this->courseModel->getFilteredCourses($params);

        $data = [
            'page_title' => 'Course List',
            'courses' => $results['courses'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'hideHeader' => true,
            'credits' => $this->courseModel->getAllCredits(),
            'semesters' => $this->courseModel->getAllSemesters(),
            'baseUrl' => base_url('course-list'),
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