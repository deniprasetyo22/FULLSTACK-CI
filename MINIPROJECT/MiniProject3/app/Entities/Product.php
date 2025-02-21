<?php

namespace App\Entities;

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $stock;
    protected $category;
    protected $slug;
    protected $isActive;
    protected $isNew;
    protected $isSale;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];
        $this->category = $data['category'];
        $this->slug = $data['slug'];
        $this->isActive = $data['is_active'];
        $this->isNew = $data['is_new'];
        $this->isSale = $data['is_sale'];
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function getIsNew()
    {
        return $this->isNew;
    }

    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
    }

    public function getIsSale()
    {
        return $this->isSale;
    }

    public function setIsSale($isSale)
    {
        $this->isSale = $isSale;
    }

    public function getAllInfo()
    {
        return "ID: {$this->id}, name: {$this->name}, price: {$this->price}, stock: {$this->stock}, category: {$this->category}";
    }
}