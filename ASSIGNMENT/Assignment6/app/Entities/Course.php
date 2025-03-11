<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Course extends Entity
{
    protected $attributes = [
        'id' => null,
        'code' => null,
        'name' => null,
        'credits' => null,
        'semester' => null,
        'created_at' => null,
        'updated_at' => null
    ];

    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'name' => 'string',
        'credits' => 'integer',
        'semester' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}