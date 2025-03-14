<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use Myth\Auth\Models\GroupModel;

class Role extends BaseController
{
    protected $groupModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
    }
    
    public function index()
    {
        $roles = $this->groupModel->findAll();
        $data = [
            'page_title' => 'Roles',
            'roles' => $roles,
            'hideHeader' => true
        ];
        return view('pages/admin/role/v_index', $data);
    }

    public function create() 
    {
        $data = [
            'page_title' => 'Create Role',
            'hideHeader' => true
        ];

        return view('pages/admin/role/v_create', $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->groupModel->save($data)) {
            return redirect()->to(base_url('admin/role'))->with('success', 'Role created successfully');
        }

        return redirect()->back()->withInput()->with('errors', $this->groupModel->errors());
    }

    public function edit($id)
    {
        $role = $this->groupModel->find($id);

        if (!$role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'Edit Role',
            'role' => $role,
            'hideHeader' => true
        ];

        return view('pages/admin/role/v_edit', $data);
    }

    public function update($id)
    {
        $role = $this->groupModel->find($id);

        if (!$role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        $rules = $this->groupModel->getValidationRules();
        $messages = $this->groupModel->getValidationMessages();

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->groupModel->update($id, $data);

        return redirect()->to(base_url('admin/role'))->with('message', 'Role updated successfully');
    }

    public function delete($id)
    {
        $role = $this->groupModel->find($id);

        if (!$role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->groupModel->delete($id);

        return redirect()->to(base_url('admin/role'))->with('message', 'Role deleted successfully');
    }
}