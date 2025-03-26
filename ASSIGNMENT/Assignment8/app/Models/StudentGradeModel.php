<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentGradeModel extends Model
{
    protected $table            = 'student_grades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\StudentGrade::class;
    protected $allowedFields    = ['id', 'enrollment_id', 'grade_value', 'grade_letter', 'completed_at', 'created_at', 'updated_at'];
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'enrollment_id' => 'required|integer',
        'grade_value' => 'required|decimal',
        'grade_letter' => 'required|string',
        'completed_at' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [
        'enrollment_id' => [
            'required' => 'Enrollment ID is required',
            'integer' => 'Enrollment ID must be an integer',
        ],
        'grade_value' => [
            'required' => 'Grade value is required',
            'decimal' => 'Grade value must be a decimal number',
        ],
        'grade_letter' => [
            'required' => 'Grade letter is required',
            'string' => 'Grade letter must be a string',
        ],
        'completed_at' => [
            'valid_date' => 'Completed date must be a valid datetime',
        ],
    ];

    public function getCreditDistrubutionByGrade($studentId)
    {
        return $this->select('student_grades.grade_letter, SUM(courses.credits) AS total_credits')
                ->join('enrollments', 'enrollments.id = student_grades.enrollment_id')
                ->join('courses', 'courses.id = enrollments.course_id')
                ->where('enrollments.student_id', $studentId)
                ->groupBy('student_grades.grade_letter')
                ->get()
                ->getResultArray();
    }
}