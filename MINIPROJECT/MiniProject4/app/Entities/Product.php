<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'description' => null,
        'price' => null,
        'stock' => null,
        'category_id' => null,
        'status' => null,
        'is_new' => null,
        'is_sale' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'stock' => 'integer',
        'category_id' => 'integer',
        'status' => 'string',
        'is_new' => 'boolean',
        'is_sale' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function getFormattedPrice(): string
    {
        return 'Rp. ' . number_format($this->attributes['price'], 2, ',', '.');
    }


    public function isInStock(): bool
    {
        return $this->attributes['stock'] > 0;
    }

    public function getStatus(): string
    {
        return ($this->attributes['status'] === 'Active') ? 'Active' : 'Inactive';
    }

    public function isSale(): bool
    {
        return (bool) $this->attributes['is_sale'];
    }
}