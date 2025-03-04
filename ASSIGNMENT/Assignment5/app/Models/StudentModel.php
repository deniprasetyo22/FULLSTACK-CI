<?php

namespace App\Models;

use App\Libraries\DataParams;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Student::class;
    protected $allowedFields    = ['student_id', 'name', 'study_program', 'current_semester', 'academic_status', 'entry_year', 'gpa'];
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $validationRules = [
        'student_id' => 'required',
        'name' => 'required',
        'study_program' => 'required',
        'current_semester' => 'required|greater_than_equal_to[1]|less_than_equal_to[8]',        
        'academic_status' => 'required|in_list[Active,On Leave,Graduated]',
        'entry_year' => 'required',
        'gpa' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[4.00]',
    ];
    protected $validationMessages = [
        'student_id'=> [
            'required'=> 'Student ID is required',
            'is_unique'=> 'Student ID must be unique',
        ],
        'name' => [
            'required' => 'Name is required'
        ],
        'study_program'=> [
            'required' => 'Study Program is required'
        ],
        'current_semester'=> [
            'required'=> 'Current Semester is required',
            'greater_than_equal_to'=> 'Current Semester must be greater than or equal to 1',
            'less_than_equal_to'=> 'Current Semester must be less than or equal to 8',
        ],
        'academic_status'=> [
            'required'=> 'Academic Status is required',
            'in_list'=> 'Academic Status must be one of [Active,On Leave,Graduated]'
        ],
        'entry_year'=> [
            'required' => 'Entry Year is required'
        ],
        'gpa'=> [
            'required'=> 'GPA is required',
            'decimal'=> 'GPA must be decimal',
            'greater_than_equal_to'=> 'GPA must be greater than or equal to 0',
            'less_than_equal_to'=> 'GPA must be less than or equal to 4.00',
        ],
    ];

    public function getFilteredUsers(DataParams $params)
    {
        if (!empty($params->search)) {// Apply search
            $this->groupStart()
                ->where('CAST(id AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(student_id AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(current_semester AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(entry_year AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(gpa AS TEXT) LIKE', "%$params->search%")
                ->orLike('academic_status', $params->search, 'both', null, true)
                ->orLike('name', $params->search, 'both', null, true)
                ->orLike('study_program', $params->search, 'both', null, true)
                ->groupEnd();
        }        
        
         //Apply Filter
        if(!empty($params->study_program)){
            $this->where('study_program', $params->study_program);
        }
        if (!empty($params->academic_status)) {
            $this->where('academic_status', $params->academic_status);
        }
        if (!empty($params->entry_year)) {
            $this->where('entry_year', $params->entry_year);
        }

         // Apply sort
         $allowedSortColumns = ['id', 'student_id', 'name', 'study_program', 'current_semester', 'academic_status', 'entry_year', 'gpa'];
         $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
         $order = ($params->order === 'desc') ? 'desc' : 'asc';
         
         $this->orderBy($sort, $order);
         
         $result = [
            'students' => $this->paginate($params->perPage, 'students', $params->page_students),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
         ];
         return $result;
    }

    public function getAllStudyProgram()
    {
        $studyPrograms = $this->select('study_program')->distinct()->findAll();
        return array_column($studyPrograms, 'study_program');
    }

    public function getAllAcademicStatus()
    {
        $academicStatus = $this->select('academic_status')->distinct()->findAll();
        return array_column($academicStatus, 'academic_status');
    }

    public function getAllEntryYear()
    {
        $entryYears = $this->select('entry_year')->distinct()->findAll();
        return array_column($entryYears, 'entry_year');
    }
}