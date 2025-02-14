<?php

namespace App\Controllers;
use App\Models\M_User;
use Config\Services;
use App\Entities\User as EntityUser;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new M_User();
    }

    public function index()
    {
        $data['users'] = $this->userModel->getAllUsers();
        return view('user/v_index', $data);
    }

    public function profile($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('user/v_profile', ['user' => $user]);
    }

    public function role($userName)
    {
        $user = $this->userModel->getUserByUserName($userName);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('user/v_role', ['user' => $user]);
    }

    public function create()
    {
        return view('user/v_create');
    }

    public function store()
    {
        $data = [
            'id'       => $this->request->getPost('id'),
            'fullName' => $this->request->getPost('fullName'),
            'userName' => $this->request->getPost('userName'),
            'sex'      => $this->request->getPost('sex'),
            'dob'      => $this->request->getPost('dob'),
            'role'     => $this->request->getPost('role'),
        ];
        
        $validation = Services::validation();
        $validation->setRules([
            'id' => 'required',
            'fullName' => 'required',
            'userName' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'role' => 'required',
        ]);

        if(!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $users = new EntityUser($data);
            $this->userModel->createUser($users);
            $data['users'] = $this->userModel->getAllUsers();
        }
        return view('user/v_index', $data);
    }

    public function setting($fullName)
    {
        $user = $this->userModel->getUserByFullName($fullName);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('user/v_setting', ['user' => $user]);
    }

    public function update($slug)
    {
        $user = $this->userModel->getUserBySlug($slug);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'id'       => $this->request->getPost('id'),
            'fullName' => $this->request->getPost('fullName'),
            'userName' => $this->request->getPost('userName'),
            'sex'      => $this->request->getPost('sex'),
            'dob'      => $this->request->getPost('dob'),
            'role'     => $this->request->getPost('role'),
        ];
        
        $validation = Services::validation();
        $validation->setRules([
            'id' => 'required',
            'fullName' => 'required',
            'userName' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'role' => 'required',
        ]);

        if(!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{

            $this->userModel->updateUser($slug, $data);
            $data['users'] = $this->userModel->getAllUsers();
        }
        
        return view('user/v_index', $data);
    }

    public function delete($slug)
    {
        $user = $this->userModel->getUserBySlug($slug);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        if($this->userModel->deleteUser($slug)) {
            $data['users'] = $this->userModel->getAllUsers();
            return view('user/v_index', $data);
        }

        return redirect()->back()->with('error', 'User gagal dihapus.');
    }
}