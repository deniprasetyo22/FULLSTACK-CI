<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Student::class;
    protected $allowedFields    = ['id', 'student_id', 'name', 'study_program', 'current_semester', 'academic_status', 'entry_year', 'gpa', 'created_at', 'updated_at'];
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

}