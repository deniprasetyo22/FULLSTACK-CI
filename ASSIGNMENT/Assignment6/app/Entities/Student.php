<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Student extends Entity
{
    protected $attributes = [
        'id' => null,
        'student_id' => null,
        'name' => null,
        'study_program' => null,
        'current_semester' => null,
        'academic_status' => null,
        'entry_year' => null,
        'gpa' => null,
        'created_at' => null,
        'updated_at' => null,
        'user_id' => null,
    ];

    protected $casts = [
        'id' => 'integer',
        'student_id' => 'integer',
        'name'=> 'string',
        'study_program' => 'string',
        'current_semester' => 'integer',
        'academic_status'=> 'string',
        'entry_year'=> 'integer',
        'gpa' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_id' => 'integer'
    ];
}