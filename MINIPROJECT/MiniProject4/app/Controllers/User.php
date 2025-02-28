<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();

        $data = [
            'page_title' => 'User List',
            'users' => $users,
            'hideHeader' => true,
        ];

        return view('pages/admin/user/v_index', $data);
    }

    public function profile($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'User Profile',
            'user' => $user,
            'hideHeader' => true
        ];

        return view('pages/admin/user/v_profile', $data);
    }

    // public function role($userName)
    // {
    //     $user = $this->userModel->getUserByUserName($userName);
    //     if (!$user) {
    //         throw PageNotFoundException::forPageNotFound();
    //     }
    //     $data['user'] = $user;
    //     $data['hideHeader'] = true;
    //     return view('pages/admin/user/v_role', $data);
    // }

    public function create()
    {
        $roles = ['Admin', 'Customer'];
        $status = ['Active', 'Inavtive'];
        
        $data = [
            'page_title' => 'Create User',
            'roles' => $roles,
            'status' => $status,
            'hideHeader' => true
        ];

        return view('pages/admin/user/v_create', $data);
    }

    public function store()
    {
        $user = new \App\Entities\User($this->request->getPost());

        $rules = $this->userModel->getValidationRules();
        $messages = $this->userModel->getValidationMessages();

        $rules['username'] = 'required|min_length[3]|is_unique[users.username]';
        $rules['email'] = 'required|valid_email|is_unique[users.email]';
        $rules['password'] = 'required|min_length[8]';

        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save($user);

        return redirect()->to('user')->with('message', 'User Added Successfully.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'Edit User',
            'user' => $user,
            'hideHeader' => true
        ];

        return view('pages/admin/user/v_edit', $data);
    }

    public function update($id)
    {
        $existingUser = $this->userModel->find($id);

        if (!$existingUser) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user = new \App\Entities\User($this->request->getPost());

        $rules = $this->userModel->getValidationRules();
        $messages = $this->userModel->getValidationMessages();

        $rules['username'] = "required|min_length[3]|is_unique[users.username,id,{$id}]";
        $rules['email'] = "required|valid_email|is_unique[users.email,id,{$id}]";

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $user->password = $user->setPassword($password);
        } else {
            $user->password = $existingUser->password;
        }

        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, $user);

        return redirect()->to('user')->with('message', 'User Updated Successfully.');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if(!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->userModel->delete($id);
        return redirect()->to('user')->with('message', 'User Deleted Successfully.');
    }

    // public function userListForUser()
    // {
    //     $parser = Services::parser();

    //     $users = $this->userModel->getAllUsers();

    //     // Konversi objek User ke array
    //     $userArray = array_map(function ($user) {
    //         return [
    //             'id'       => $user->getUserId(),
    //             'fullName' => $user->getFullName(),
    //             'userName' => $user->getUserName(),
    //             'sex'      => $user->getSex(),
    //             'dob'      => $user->getDob(),
    //             'role'     => $user->getRole(),
    //             'slug'     => $user->getUserSlug(),
    //         ];
    //     }, $users);

    //     $data['users'] = $userArray;

    //     $data['content'] = $parser->setData($data)->render('components/user_list');

    //     return view('pages/public/user/v_user_list', $data);
    // }

    // public function userDetailForUser($slug)
    // {
    //     $parser = Services::parser();

    //     $user = $this->userModel->getUserBySlug($slug);

    //     if ($user == null) {
    //         throw PageNotFoundException::forPageNotFound();
    //     }

    //     $dob = date('F d, Y', strtotime($user->getDob()));

    //     $data = [
    //         'id'       => $user->getUserId(),
    //         'fullName' => $user->getFullName(),
    //         'userName' => $user->getUserName(),
    //         'sex'      => $user->getSex(),
    //         'dob'      => $dob,
    //         'role'     => $user->getRole(),
    //         'slug'     => $user->getUserSlug(),
    //         'activity_history'=> 'Last login: 2025-02-20, 10:00 AM',
    //         'account_status'  => 'Active',
    //     ];

    //     $data['user_profile_cell'] = view_cell('UserProfileCell', ['userName' => $user->getUserName()], 300, 'user_profile_cell');

    //     $data['content'] = $parser->setData($data)->render('components/user_detail');

    //     return view('pages/public/user/v_user_detail', $data);
    // }
}