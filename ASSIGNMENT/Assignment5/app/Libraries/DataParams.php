<?php
namespace App\Libraries;
class DataParams
{
    public $search = '';
    public $study_program = '';
    public $academic_status = '';
    public $entry_year = '';
    public $sort = 'id';
    public $order = 'asc';
    public $page = 1;
    public $perPage = 10;
    public $credits = '';
    public $semester = '';

    public function __construct(array $params = [])
    {
        $this->search = $params['search'] ?? '';
        $this->study_program = $params['study_program'] ?? '';
        $this->academic_status = $params['academic_status'] ?? '';
        $this->entry_year = $params['entry_year'] ?? '';
        $this->sort = $params['sort'] ?? 'id';
        $this->order = $params['order'] ?? 'asc';
        $this->page = (int) ($params['page'] ?? 1);
        $this->perPage = (int) ($params['perPage'] ?? 5);
        $this->credits = $params['credits'] ?? '';
        $this->semester = $params['semester'] ?? '';
    }

    public function getParams()
    {
    return [
        'search' => $this->search,
        'study_program'=> $this->study_program,
        'academic_status'=> $this->academic_status,
        'entry_year'=> $this->entry_year,
        'sort' => $this->sort,
        'order' => $this->order,
        'page' => $this->page,
        'perPage' => $this->perPage,
        'credits' => $this->credits,
        'semester' => $this->semester
    ];
    }

    public function getSortUrl($column, $baseUrl)
    {
        $params = $this->getParams();
            
        // Set sort to column and toggle order if already sorted by this column
        $params['sort'] = $column;
        $params['order'] = ($column == $this->sort && $this->order == 'asc') ? 'desc' : 'asc';
                
        // Build query string
        $queryString = http_build_query(array_filter($params));
        return $baseUrl . '?' . $queryString;
    }

    public function getResetUrl($baseUrl)
    {
        return $baseUrl;
    }


    public function isSortedBy($column)
    {
        return $this->sort === $column;
    }


    public function getSortDirection()
    {
        return $this->order;
    }

}