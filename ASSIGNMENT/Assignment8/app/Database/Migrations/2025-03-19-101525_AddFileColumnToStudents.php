<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFileColumnToStudents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('students', [
            'file' => [
                'type' => 'varchar',
                'constraint' => 255
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('students', 'file');
    }
}