<?php

namespace App\Controllers;
use App\Models\M_User;
use Config\Services;
use App\Entities\User as EntityUser;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

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
        $data['hideHeader'] = true;
        return view('pages/admin/user/v_index', $data, ['cache' => 900, 'cache_name' => 'user_list_admin']);
    }

    public function profile($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data['user'] = $user;
        $data['hideHeader'] = true;
        return view('pages/admin/user/v_profile', $data);
    }

    public function role($userName)
    {
        $user = $this->userModel->getUserByUserName($userName);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data['user'] = $user;
        $data['hideHeader'] = true;
        return view('pages/admin/user/v_role', $data);
    }

    public function create()
    {
        return view('pages/admin/user/v_create', ['hideHeader' => true]);
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
            'slug'     => $this->request->getPost('slug'),
        ];
        
        $validation = Services::validation();
        $validation->setRules([
            'id' => 'required',
            'fullName' => 'required',
            'userName' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'role' => 'required',
            'slug' => 'required',
        ]);

        if(!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $users = new EntityUser($data);
            $this->userModel->createUser($users);
            $data['users'] = $this->userModel->getAllUsers();
        }
        $data['hideHeader'] = true;
        return view('pages/admin/user/v_index', $data);
    }

    public function setting($fullName)
    {
        $user = $this->userModel->getUserByFullName($fullName);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data['user'] = $user;
        $data['hideHeader'] = true;
        return view('pages/admin/user/v_setting', $data);
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
            $data['hideHeader'] = true;
        }
        
        return view('pages/admin/user/v_index', $data);
    }

    public function delete($slug)
    {
        $user = $this->userModel->getUserBySlug($slug);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        if($this->userModel->deleteUser($slug)) {
            $data['users'] = $this->userModel->getAllUsers();
            $data['hideHeader'] = true;
            return view('pages/admin/user/v_index', $data);
        }

        return redirect()->back()->with('error', 'User gagal dihapus.');
    }

    public function userListForUser()
    {
        $parser = Services::parser();

        $users = $this->userModel->getAllUsers();

        // Konversi objek User ke array
        $userArray = array_map(function ($user) {
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

        $data['users'] = $userArray;

        $data['content'] = $parser->setData($data)->render('components/user_list');

        return view('pages/public/user/v_user_list', $data);
    }

    public function userDetailForUser($slug)
    {
        $parser = Services::parser();

        $user = $this->userModel->getUserBySlug($slug);

        if ($user == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $dob = date('F d, Y', strtotime($user->getDob()));

        $data = [
            'id'       => $user->getUserId(),
            'fullName' => $user->getFullName(),
            'userName' => $user->getUserName(),
            'sex'      => $user->getSex(),
            'dob'      => $dob,
            'role'     => $user->getRole(),
            'slug'     => $user->getUserSlug(),
            'activity_history'=> 'Last login: 2025-02-20, 10:00 AM',
            'account_status'  => 'Active',
        ];

        $data['user_profile_cell'] = view_cell('UserProfileCell', ['userName' => $user->getUserName()], 300, 'user_profile_cell');

        $data['content'] = $parser->setData($data)->render('components/user_detail');

        return view('pages/public/user/v_user_detail', $data);
    }
}