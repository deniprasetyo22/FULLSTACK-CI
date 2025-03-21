<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ProductImage extends Entity
{
    protected $attributes = [
        'id' => null,
        'product_id' => null,
        'image_path' => null,
        'is_primary' => null,
        'created_at' => null,
    ];
    protected $casts   = [
        'id' => 'integer',
        'product_id' => 'integer',
        'image_path' => 'string',
        'is_primary' => 'boolean',
        'created_at' => 'datetime',
    ];
}