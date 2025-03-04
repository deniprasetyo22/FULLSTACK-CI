<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        try {
            // $db = \Config\Database::connect();
        
            // // $db = db_connect();
        
            // $db->initialize();
            
            /* Test Connection */
            // if ($db->connID) {
            //     echo "Koneksi database berhasil!";
            //     print_r($db->getDatabase());  
            // }

            /* Query Basics (native SQL) */
            // print_r($db->query('SELECT * FROM student')->getResult());

            /* Insert */
            // $sql = "INSERT INTO student (name, status, age) VALUES (?, ?, ?)";
            // $db->query($sql, ['John Doe', 'active', 25]);

            /* Update */
            // $sql = "UPDATE student SET name = ?, status = ?, age = ? WHERE id = ?";
            // $db->query($sql, ['John Doe', 'Inactive', 30, 6]);

            /* Delete */
            // $sql = "DELETE FROM student WHERE id = ?";
            // $db->query($sql, [6]);

            /* Query Result - getResult() */
            // $query = $db->query('SELECT * from student');
            // foreach ($query->getResult() as $row) {
            //     echo $row->id;
            //     echo $row->name;
            //     echo $row->status;
            //     echo '<br>';
            // }

            /* Query Result - getRow() */
            // $sql = "SELECT * FROM student WHERE id = ?";
            // $query = $db->query($sql, [1]);
            // $row = $query->getRow();
            // if (isset($row)) {
            //     echo $row->id;
            //     echo $row->name;
            //     echo $row->status;
            // }     
            
            // $sql = "SELECT * FROM student";
            // $query = $db->query($sql);
            // $row = $query->getRow(1);
            // // $row = $query->getFirstRow();
            // // $row = $query->getLastRow();
            // // $row = $query->getNextRow();
            // // $row = $query->getPreviousRow();  
            // // $row = $query->getRow(0, \App\Entities\User::class);         
            // if (isset($row)) {
            //     echo $row->id;
            //     echo $row->name;
            //     echo $row->status;
            // }           
            
            /* Escaping Values */
            // $sql = 'SELECT * FROM student WHERE id = ? AND name = ? AND status = ?';
            // print_r($db->query($sql, [1, 'deni', 'active'])->getResult());



            /* Query Builder */
            // $db      = \Config\Database::connect();
            // $builder = $db->table('students');

            /* Get */
            // $query   = $builder->get();

            /* Limit */
            // $query   = $builder->get(1, 2);

            /* Select */
            // $builder->select('id, name, status');
            // $query = $builder->get();
            
            // foreach ($query->getResult() as $row) {
            //     echo $row->id;
            //     echo $row->name;
            //     echo $row->status;
            //     echo $row->age;
            //     echo '<br>';
            // }          
            
            
            /* Max Min */
            // $builder->selectMax('age');
            // $builder->selectMin('age');
            // $builder->selectAvg('age');
            // $builder->selectSum('age');
            // $builder->selectCount('age');
            // $query = $builder->get();
            // $result = $query->getResult();
            // print_r($result);


            /* Latihan */
            $db      = \Config\Database::connect();
            $builder = $db->table('students');

            $builder->select('student_id, name, entry_year, study_program');
            $builder->where('academic_status', 'active');
            $builder->orderBy('student_id', 'asc');
            foreach ($builder->get()->getResult() as $row) {
                echo $row->student_id;
                echo $row->name;
                echo $row->entry_year;
                echo $row->study_program;
                echo '<br>';
            }
        
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}