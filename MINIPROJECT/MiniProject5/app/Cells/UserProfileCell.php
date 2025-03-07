<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class UserProfileCell extends Cell
{
    public $userName;

    public function mount(string $userName)
    {
        $this->userName = $userName;
    }
    
}