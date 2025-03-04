<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table            = 'enrollments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Enrollment::class;
    protected $allowedFields    = ['id', 'student_id', 'course_id', 'academic_year', 'semester', 'status', 'created_at', 'updated_at'];
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'student_id' => 'required|integer',
        'course_id' => 'required|integer',
        'academic_year' => 'required|integer',
        'semester' => 'required|integer',
        'status' => 'required|string',
    ];

    protected $validationMessages = [
        'student_id' => [
            'required' => 'Student ID is required',
            'integer' => 'Student ID must be an integer',
        ],
        'course_id' => [
            'required' => 'Course ID is required',
            'integer' => 'Course ID must be an integer',
        ],
        'academic_year' => [
            'required' => 'Academic Year is required',
            'integer' => 'Academic Year must be an integer',
        ],
        'semester' => [
            'required' => 'Semester is required',
            'integer' => 'Semester must be an integer',
        ],
        'status' => [
            'required' => 'Status is required',
            'string' => 'Status must be a string',
        ],
    ];
}