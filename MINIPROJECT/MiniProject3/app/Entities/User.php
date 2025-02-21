<?php

namespace App\Entities;

class User
{
    protected $id;
    protected $fullName;
    protected $userName;
    protected $sex;
    protected $dob;
    protected $role;
    protected $slug;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->fullName = $data['fullName'];
        $this->userName = $data['userName'];
        $this->sex = $data['sex'];
        $this->dob = $data['dob'];
        $this->role = $data['role'];
        $this->slug = $data['slug'];
    }

    public function getUserSlug()
    {
        return $this->slug;
    }

    public function setUserSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getUserId()
    {
        return $this->id;
    }

    public function setUserId($id)
    {
        $this->id = $id;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}

?>