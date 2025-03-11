<?php 

namespace App\Controllers;

use Myth\Auth\Controllers\AuthController as MythAuthController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Auth extends MythAuthController
{
    protected $auth;
    protected $config;
    protected $userModel;
    protected $groupModel;
    
    public function __construct()
    {
        parent::__construct();

        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();

        $this->auth = service('authentication');
    }

    public function login()
    {
        // Custom logic login
        return parent::login(); 
    }

    public function attemptLogin()
    {
        // Custom validation atau logic tambahan
        $result = parent::attemptLogin();
        return $this->redirectBasedOnRole();
    }

    private function redirectBasedOnRole()
    {
        $userId = user_id();

        if(!$userId){
            return redirect()->to('login');
        }
            
        $userGroups = $this->groupModel->getGroupsForUser($userId);
            
        foreach ($userGroups as $group) {
            if ($group['name'] === 'admin') {
                return redirect()->to('admin/dashboard');
            } else if ($group['name'] === 'lecturer') {
                return redirect()->to('lecturer/dashboard');
            } else if ($group['name'] === 'student') {
                return redirect()->to('student/dashboard');
            }
        }
    
        return redirect()->to('/');
    }

    public function attemptRegister()
    {
        // Jalankan registrasi bawaan
        $result = parent::attemptRegister();
        
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {           
             // Tambahkan ke group student
            $studentGroup = $this->groupModel->where('name', 'student')->first();
            if ($studentGroup) {
                $this->groupModel->addUserToGroup($user->id, $studentGroup->id);
            }
        }             
        return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));



        // // Check if registration is allowed
        // if (! $this->config->allowRegistration) {
        //     return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
        // }

        // $users = model(UserModel::class);

        // // Validate basics first since some password rules rely on these fields
        // $rules = config('Validation')->registrationRules ?? [
        //     'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
        //     'email'    => 'required|valid_email|is_unique[users.email]',
        // ];

        // if (! $this->validate($rules)) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // // Validate passwords since they can only be validated properly here
        // $rules = [
        //     'password'     => 'required|strong_password',
        //     'pass_confirm' => 'required|matches[password]',
        // ];

        // if (! $this->validate($rules)) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // // Save the user
        // $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        // $user              = new UserModel($this->request->getPost($allowedPostFields));

        // $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // if (! $users->save($user)) {
        //     return redirect()->back()->withInput()->with('errors', $users->errors());
        // }

        // // Tambahkan user ke grup student jika registrasi sukses
        // $studentGroup = $this->groupModel->where('name', 'student')->first();
        // if ($studentGroup) {
        //     $this->groupModel->addUserToGroup($users->insertID(), $studentGroup->id);
        // }

        // if ($this->config->requireActivation !== null) {
        //     $activator = service('activator');
        //     $sent      = $activator->send($user);

        //     if (! $sent) {
        //         return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        //     }

        //     // Success!
        //     return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
        // }

        // // Success!
        // return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
    }
}

?>