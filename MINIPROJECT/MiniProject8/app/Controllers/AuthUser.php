<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel as AuthUserModel;
use TCPDF;

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

        // Data untuk tabel auth_users
        $authUserData = [
            'id'       => $id,
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'active'   => $this->request->getPost('status') === 'Active' ? 1 : 0,
        ];

        // Jika password tidak kosong, hash password
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $authUserData['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        } else {
            unset($authUserData['password_hash']);
        }

        // Data untuk tabel users
        $userData = [
            'user_id'   => $id,
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'status'    => $this->request->getPost('status'),
        ];

        $rules = $this->authUserModel->getValidationRules();
        $messages = $this->authUserModel->getValidationMessages();

        $rules['username'] = "required|min_length[3]|is_unique[users.username,id,{$id}]";
        $rules['email'] = "required|valid_email|is_unique[users.email,id,{$id}]";

        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update auth_users
        $authUpdate = $this->authUserModel->update($id, $authUserData);

        // Update users berdasarkan user_id
        $userUpdate = $this->userModel->where('user_id', $id)->set($userData)->update();


        if ($authUpdate && $userUpdate) {
            return redirect()->to(base_url('admin/auth'))->with('message', 'User updated successfully');
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


    /* Export User List PDF */
    public function exportPDF()
    {
        $users = $this->authUserModel->findAll();

        $pdf = $this->initTcpdf();
        $this->generatePdfHtmlContent($pdf, $users);

        $fileName = 'User_list_'.date('Y-m-d').'.pdf';
        $pdf->Output($fileName, 'I');
        exit();
    }

    private function initTcpdf()
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('CodeIgniter4');
        $pdf->SetAuthor('Administrator');
        $pdf->SetTitle('User List PDF');
        $pdf->SetSubject('User List PDF');

        $pdf->SetHeaderData('', '0', 'Online Food Ordering System', '', [0, 0, 0], [0, 0, 0]);
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 8]);

        $pdf->SetMargins(15, 20, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        
        $pdf->SetAutoPageBreak(true, 25);
        
        $pdf->SetFont('helvetica', '', 10);
        
        $pdf->AddPage();
        
        return $pdf;
    }

    private function generatePdfHtmlContent($pdf, $users)
    {
        $title = 'User List';

        $html = '<h2 style="text-align:center;">'. $title .'</h2>
        <table border="1" cellpadding="5" style="width:100%;">
            <thead>
            <tr style="background-color:#CCCCCC; font-weight:bold; text-align:center;">
                <th style="width:10%;">No</th>
                <th style="width:30%;">Username</th>
                <th style="width:30%;">Email</th>
                <th style="width:30%;">Registration Date</th>
            </tr>
            </thead>
            <tbody>';
        
            $no = 1;
            foreach ($users as $user) {
            $html .= '
            <tr>
                <td style="text-align:center; width:10%;">' . $no . '</td>
                <td style="width:30%;">' . $user->username . '</td>
                <td style="width:30%;">' . $user->email . '</td>
                <td style="width:30%;">' . $user->created_at . '</td>
            </tr>';
            $no++;
            }
            
        $html .= '
            </tbody>
            </table>
            
            <p style="margin-top:30px; text-align:left;">      
                <b> Total User: ' . count($users) . '</b> 
            </p>
    
            <p style="margin-top:30px; text-align:right;">    
                <i>Tanggal Cetak: ' . date('d-m-Y H:i:s') .  '</i><br> 
            </p>';
            $pdf->writeHTML($html, true, false, true, false, '');  
    }
    


}