<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class StudentGrade extends Entity
{
    protected $attributes = [
        'id' => null,
        'enrollment_id' => null,
        'grade_value' => null,
        'grade_letter' => null,
        'completed_at' => null,
        'created_at' => null,
        'updated_at' => null
    ];

    protected $casts = [
        'id' => 'integer',
        'enrollment_id' => 'integer',
        'grade_value' => 'float',
        'grade_letter' => 'string',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}