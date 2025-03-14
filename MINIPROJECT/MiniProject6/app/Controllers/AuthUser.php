<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel as AuthUserModel;

class AuthUser extends BaseController
{
    protected $authUserModel;
    protected $roleModel;
    protected $userModel;

    public function __construct()
    {
        $this->authUserModel = new AuthUserModel();
        $this->roleModel = new GroupModel();
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        $users = $this->authUserModel->getAllUserWithUserAccount()->findAll();
        $roles = array_map(fn($role) => $role->toArray(), $this->roleModel->findAll());

        $data = [
            'page_title' => 'User List',
            'users' => $users,
            'baseUrl' => base_url('admin/user'),
            'hideHeader' => true,
            'roles' => $roles
        ];

        return view('pages/admin/auth_user/v_index', $data);
    }

    public function profile($id)
    {
        $user = $this->authUserModel->getAllUserWithUserAccount()->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'User Profile',
            'user' => $user,
            'hideHeader' => true
        ];

        return view('pages/admin/auth_user/v_profile', $data);
    }

    public function create()
    {
        $roles = array_map(fn($role) => $role->toArray(), $this->roleModel->findAll());
        $status = [
            'Active',
            'Inavtive'
        ];
        
        $data = [
            'page_title' => 'Create User',
            'roles' => $roles,
            'status' => $status,
            'hideHeader' => true
        ];

        return view('pages/admin/auth_user/v_create', $data);
    }

    public function store()
    {
        $authUser = new \Myth\Auth\Entities\User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'active'   => 1,
        ]);
    
        if (!$this->authUserModel->save($authUser)) {
            return redirect()->back()->withInput()->with('errors', $this->authUserModel->errors());
        }
    
        // Ambil ID user yang baru saja disimpan
        $userId = $this->authUserModel->insertID();
    
        // Tambahkan user ke grup (role)
        $groupId = $this->request->getPost('role');
        $role = $this->roleModel->find($groupId);
        $this->roleModel->addUserToGroup($userId, $groupId);
    
        // Simpan data user tambahan ke tabel user
        $dataUser = [
            'user_id'   => $userId,
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'role'      => $role->name,
            'status'    => $this->request->getPost('status'),
        ];
    
        if ($this->userModel->save($dataUser)) {
            return redirect()->to(base_url('admin/auth'))->with('success', 'User created successfully');
        }
    
        return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
    }
    
    public function edit($id)
    {
        $user = $this->authUserModel->getAllUserWithUserAccount()->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $roles = $this->roleModel->findAll();

        $status = [
            'Active',
            'Inavtive'
        ];

        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'roles' => $roles,
            'status' => $status,
            'hideHeader' => true
        ];

        return view('pages/admin/auth_user/v_edit', $data);
    }

    public function update($id)
    {
        $user = $this->authUserModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $role = $this->roleModel->find($this->request->getPost('role'));

        // Data untuk tabel auth_users
        $authUserData = [
            'id'       => $id,
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'active'   => $this->request->getPost('status') === 'Active' ? 1 : 0,
        ];

        // Jika password diisi, hash dan tambahkan ke array
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $authUserData['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Data untuk tabel users
        $userData = [
            'user_id'   => $id,
            'full_name' => $this->request->getPost('full_name'),
            'role'      => $role ? $role->name : null,
            'status'    => $this->request->getPost('status'),
        ];

        // Update auth_users
        $authUpdate = $this->authUserModel->update($id, $authUserData);

        // Update users berdasarkan user_id
        $userUpdate = $this->userModel->where('user_id', $id)->set($userData)->update();

        if ($authUpdate && $userUpdate) {
            return redirect()->to(base_url('admin/auth'))->with('success', 'User updated successfully');
        }

        return redirect()->back()->withInput()->with('errors', 'Failed to update user');
    }

    public function delete($id)
    {
        $user = $this->authUserModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (isset($this->userModel)) {
            $this->userModel->where('user_id', $id)->delete();
        }

        $this->authUserModel->delete($id);

        return redirect()->to(base_url('admin/auth'))->with('message', 'User deleted successfully');
    }

    public function changeRole($id)
    {
        $user = $this->authUserModel->getAllUserWithUserAccount()->find($id);
        $roles = array_map(fn($role) => $role->toArray(), $this->roleModel->findAll());

        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'Change Role',
            'user'  => $user,
            'hideHeader' => true,
            'roles' => $roles
        ];

        return view('pages/admin/auth_user/v_change_role', $data);
    }

    public function updateRole($id)
    {
        $groupModel = new GroupModel();
        $roleId = $this->request->getPost('role');
    
        if (!$roleId) {
            return redirect()->back()->withInput()->with('errors', 'Role is required');
        }
    
        $roleData = $groupModel->find($roleId);
        if (!$roleData) {
            return redirect()->back()->withInput()->with('errors', 'Invalid Role ID');
        }
        $roleName = $roleData->name;
    
        $groupModel->removeUserFromAllGroups($id);
    
        $currentUser = $this->userModel->where('user_id', $id)->first();
        
        if ($groupModel->addUserToGroup($id, $roleId)) {
            $this->userModel->update($currentUser->id, ['role' => $roleName]);
    
            return redirect()->to(base_url('admin/auth'))->with('message', 'Role updated successfully');
        }
    
        return redirect()->back()->withInput()->with('errors', 'Failed to update role');
    }
    


}