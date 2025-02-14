<?php

namespace App\Models;

use App\Entities\User;

class M_User
{
    private $users = [];

    public function __construct()
    {
        $this->users = [
            new User(['id' => 1, 'fullName' => 'Deni Prasetyo', 'userName' => 'deni123', 'sex' => 'Laki-laki', 'dob' => '2000-01-01', 'role' => 'admin', 'slug' => 'deni123']),
            new User(['id' => 2, 'fullName' => 'Budi Setiawan', 'userName' => 'budi123', 'sex' => 'Laki-laki', 'dob' => '2000-08-10', 'role' => 'user', 'slug' => 'budi123']),
            new User(['id' => 3, 'fullName' => 'Andi Kurniawan', 'userName' => 'andi123', 'sex' => 'Laki-laki', 'dob' => '2000-11-15', 'role' => 'user', 'slug' => 'andi123']),
        ];
    }

    public function getAllUsers()
    {
        return $this->users;
    }

    public function getUserBySlug($slug)
    {
        foreach ($this->users as $user){
            if($user->getUserSlug() == $slug){
                return $user;
            }
        }
        return null;
    }

    public function getUserById($id)
    {
        foreach ($this->users as $user){
            if($user->getUserId() == $id){
                return $user;
            }
        }
        return null;
    }

    public function getUserByUserName($userName)
    {
        foreach ($this->users as $user){
            if($user->getUserName() == $userName){
                return $user;
            }
        }
        return null;
    }

    public function getUserByFullName($fullName)
    {
        $generateFullName = strtolower(str_replace(' ', '', $fullName));
        
        foreach ($this->users as $user) {
            if (strtolower(str_replace(' ', '', $user->getFullName())) === $generateFullName) {
                return $user;
            }
        }
        return null;
    }

    public function createUser(User $user)
    {
        $this->users[] = $user;
    }

    public function updateUser($slug, array $data)
    {
        foreach ($this->users as $index => $u) {
            if ($u->getUserSlug() == $slug) {
                $u->setUserId($data['id']);
                $u->setFullName($data['fullName']);
                $u->setUserName($data['userName']); 
                $u->setSex($data['sex']);
                $u->setDob($data['dob']);
                $u->setRole($data['role']);
                return true;
            }
        }
        return false;
    }

    public function deleteUser($slug)
    {
        foreach ($this->users as $index => $u) {
            if ($u->getUserSlug() == $slug) {
                unset($this->users[$index]);

                return true;
            }
        }
        return false;
    }
}

?>