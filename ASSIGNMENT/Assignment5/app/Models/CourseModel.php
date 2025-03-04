<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Course::class;
    protected $allowedFields    = ['id', 'code', 'name', 'credits', 'semester', 'created_at', 'updated_at'];
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    
    protected $validationRules = [
        'code' => 'required|exact_length[8]',
        'name' => 'required',
        'credits' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[6]',
        'semester' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[8]',
    ];

    protected $validationMessages = [
        'code'=> [
            'required'=> 'Course code is required',
            'is_unique'=> 'Course code must be unique',
        ],
        'name' => [
            'required' => 'Course name is required'
        ],
        'credits' => [
            'required' => 'Credits are required',
            'integer' => 'Credits must be an integer',
            'greater_than_equal_to' => 'Credits must be greater than or equal to 0',
            'less_than_equal_to' => 'Credits must be less than or equal to 6',
        ],
        'semester' => [
            'required' => 'Semester is required',
            'integer' => 'Semester must be an integer',
            'greater_than_equal_to' => 'Semester must be greater than or equal to 1',
            'less_than_equal_to' => 'Semester must be less than or equal to 8',
        ],
    ];
}