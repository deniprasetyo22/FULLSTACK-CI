<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\User::class;
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'full_name', 'role', 'status', 'last_login'];
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]',
        'email'    => 'required|valid_email',
        'full_name'=> 'required',
        'role'     => 'required',
        'status'   => 'required'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required.',
            'min_length' => 'Username must be 3 characters minimum.',
            'is_unique' => 'Username already exists.'
        ],
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Email format invalid.',
            'is_unique' => 'Email already exists.'
        ],
        'password' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be 8 characters minimum.'
        ],
        'full_name' => [
            'required' => 'Name is required.'
        ],
        'role' => [
            'required' => 'Role is required.'
        ],
        'status' => [
            'required' => 'status is required.'
        ]
    ];
    
    public function findActiveUsers()
    {
        return $this->where('status', 'active')->findAll();
    }

    public function getTotalUsers(): int
    {
        return $this->countAllResults();
    }

    public function getNewUsersThisMonth(): int
    {
        return $this->where('created_at >=', date('Y-m-01'))
                    ->where('created_at <=', date('Y-m-t'))
                    ->countAllResults();
    }

    public function updateLastLogin(int $userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }

    public function getUserStatistics(): array
    {
        $totalUsers = $this->countAllResults();
        $activeUsers = $this->where('status', 'active')->countAllResults();
        $newUsersThisMonth = $this->where('created_at >=', date('Y-m-01'))
                                  ->where('created_at <=', date('Y-m-t'))
                                  ->countAllResults();

        $lastMonthUsers = $this->where('created_at >=', date('Y-m-01', strtotime('-1 month')))
                               ->where('created_at <=', date('Y-m-t', strtotime('-1 month')))
                               ->countAllResults();
        $growthPercentage = ($lastMonthUsers > 0) ? (($newUsersThisMonth / $lastMonthUsers) * 100) : ($newUsersThisMonth > 0 ? 100 : 0);

        return [
            'total_users' => $totalUsers,
            'active_users' => $activeUsers,
            'new_users_this_month' => $newUsersThisMonth,
            'growth_percentage' => round($growthPercentage, 2)
        ];
    }

}