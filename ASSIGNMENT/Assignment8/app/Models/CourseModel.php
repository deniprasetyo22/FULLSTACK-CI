<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Course::class;
    protected $allowedFields    = ['code', 'name', 'credits', 'semester'];
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    
    protected $validationRules = [
        'code' => 'required|exact_length[8]',
        'name' => 'required',
        'credits' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[6]',
        'semester' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[8]',
    ];

    protected $validationMessages = [
        'code'=> [
            'required'=> 'Course code is required',
            'is_unique'=> 'Course code must be unique',
        ],
        'name' => [
            'required' => 'Course name is required'
        ],
        'credits' => [
            'required' => 'Credits are required',
            'integer' => 'Credits must be an integer',
            'greater_than_equal_to' => 'Credits must be greater than or equal to 0',
            'less_than_equal_to' => 'Credits must be less than or equal to 6',
        ],
        'semester' => [
            'required' => 'Semester is required',
            'integer' => 'Semester must be an integer',
            'greater_than_equal_to' => 'Semester must be greater than or equal to 1',
            'less_than_equal_to' => 'Semester must be less than or equal to 8',
        ],
    ];

    public function getFilteredCourses($params)
    {
        //Search
        if(!empty($params->search)){
            $this->groupStart()
                ->where('CAST(id AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(code AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(credits AS TEXT) LIKE', "%$params->search%")
                ->orWhere('CAST(semester AS TEXT) LIKE', "%$params->search%")
                ->orLike('name', $params->search, 'both', null, true)
                ->groupEnd();
        }

        //Filter
        if(!empty($params->credits)){
            $this->where('credits', $params->credits);
        }
        if(!empty($params->semester)){
            $this->where('semester', $params->semester);
        }

        //Sort
        $allowedSortColumns = ['id', 'code', 'name', 'credits', 'semester'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';
        $this->orderBy($sort, $order);
        
        $result = [
            'courses' => $this->paginate($params->perPage, 'courses', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];
        return $result;
    }

    public function getAllCredits()
    {
        $credits = $this->select('credits')->distinct()->findAll();
        return array_column($credits, 'credits');
    }

    public function getAllSemesters()
    {
        $semesters = $this->select('semester')->distinct()->findAll();
        return array_column($semesters, 'semester');
    }
}