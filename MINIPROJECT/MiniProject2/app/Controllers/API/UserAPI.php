<?php

namespace App\Controllers\API;

use App\Models\M_User;
use CodeIgniter\RESTful\ResourceController;

class UserApi extends ResourceController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new M_User();
    }

    public function index()
    {
        return view('api/v_index');
    }

    public function getAllUsers()
    {
        $users = $this->userModel->getAllUsers();

        // Ubah objek User menjadi array
        $data = array_map(function($user) {
            return [
                'id'       => $user->getUserId(),
                'fullName' => $user->getFullName(),
                'userName' => $user->getUserName(),
                'sex'      => $user->getSex(),
                'dob'      => $user->getDob(),
                'role'     => $user->getRole(),
                'slug'     => $user->getUserSlug(),
            ];
        }, $users);

        // Response JSON
        return $this->response->setJSON([
            'status'  => 200,
            'message' => 'All Users',
            'data'    => $data
        ]);
    }

    public function getUserById()
    {
        $id = $this->request->getGet('id');
        // Ambil user berdasarkan ID
        $user = $this->userModel->getUserById($id);

        // Jika user tidak ditemukan
        if (!$user) {
            return $this->response->setJSON([
                'status'  => 404,
                'message' => 'User not found'
            ]);
        }

        // Ubah objek User menjadi array
        $data = [
            'id'       => $user->getUserId(),
            'fullName' => $user->getFullName(),
            'userName' => $user->getUserName(),
            'sex'      => $user->getSex(),
            'dob'      => $user->getDob(),
            'role'     => $user->getRole(),
            'slug'     => $user->getUserSlug(),
        ];

        // Response JSON
        return $this->response->setJSON([
            'status'  => 200,
            'message' => 'User Details',
            'data'    => $data
        ]);
    }
    


}

?>