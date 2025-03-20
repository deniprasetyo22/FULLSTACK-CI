<?php

namespace App\Controllers;

use App\Models\UserModel as UserProfileModel;
use Myth\Auth\Controllers\AuthController as MythAuthController;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;

class Auth extends MythAuthController
{
    protected $auth;
    protected $config;
    protected $userModel;
    protected $groupModel;
    protected $userProfileModel;

    public function __construct()
    {
        parent::__construct();

        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->userProfileModel = new UserProfileModel();

        $this->auth = service('authentication');
    }

    public function login()
    {
        if ($this->auth->check()) {
            return redirect()->to('home');
        }
        
        return parent::login();
    }

    public function attemptLogin()
    {
        parent::attemptLogin();
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
            if ($group['name'] === 'administrator') {
                return redirect()->to('admin/admin-dashboard');
            } else if ($group['name'] === 'product_manager') {
                return redirect()->to('manager/manager-dashboard');
            } else if ($group['name'] === 'customer') {
                return redirect()->to('home');
            }
        }
    
        return redirect()->to('/');
    }

    public function attemptRegister()
    {
        return parent::attemptRegister();
    }

}