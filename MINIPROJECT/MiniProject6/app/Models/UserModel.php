<?php

namespace App\Models;

use App\Libraries\DataParams;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users_profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\User::class;
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'full_name', 'role', 'status', 'last_login', 'user_id'];
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
        return $this->where('status', 'Active')->findAll();
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

    public function getFilteredUsers(DataParams $params)
    {
        //Search
        if (!empty($params->search)) {
            $this->groupStart()
            ->where('CAST(id as TEXT) LIKE', "%$params->search%")
            ->orLike('full_name', $params->search, 'both', null, true)
            ->orLike('username', $params->search, 'both', null, true)
            ->orLike('role', $params->search, 'both', null, true)
            ->orLike('status', $params->search, 'both', null, true)
            ->groupEnd();
        }

        //Filter
        if(!empty($params->role)){
            $this->where('role', $params->role);
        }
        if (!empty($params->status)) {
            $this->where('status', $params->status);
        }

        //Sorting
        $allowedSortColumns = ['username', 'email', 'last_login'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';

        $this->orderBy($sort, $order);

        $results = [
            'users' => $this->paginate($params->perPage ?? 5, 'users', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];

        return $results;
    }

    public function getAllRoles()
    {
        $roles = $this->select('role')->distinct()->findAll();
        return array_column($roles, 'role');
    }

    public function getAllStatus()
    {
        $status = $this->select('status')->distinct()->findAll();
        return array_column($status, 'status');
    }

}