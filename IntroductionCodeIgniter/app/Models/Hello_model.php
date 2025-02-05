<?php 
namespace App\Models;

use CodeIgniter\Model;

class Hello_model extends Model
{
    public function hello()
    {
        return 'Hello world from model';
    }
}