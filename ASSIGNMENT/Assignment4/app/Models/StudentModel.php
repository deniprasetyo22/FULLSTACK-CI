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
        'student_id' => 'required|is_unique[students.student_id]',
        'name' => 'required',
        'study_program' => 'required',
        'current_semester' => 'required',        
        'academic_status' => 'required',
        'entry_year' => 'required',
        'gpa' => 'required',
    ];
    protected $validationMessages = [
        'student_id'=> [
            'required'=> 'Student ID is required',
            'is_unique'=> 'Student ID must be unique',
        ],
        'name' => 'Name is required',
        'study_program'=> 'Study Program is required',
        'current_semester'=> 'Current Semester is required',
        'academic_status'=> 'Academic Status is required',
        'entry_year'=> 'Entry Year is required',
        'gpa'=> 'GPA is required',
    ];

}