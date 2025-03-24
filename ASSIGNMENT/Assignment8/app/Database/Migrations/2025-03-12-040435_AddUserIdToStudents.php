<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToStudents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('students', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'unique'     => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->db->query('ALTER TABLE students ADD CONSTRAINT students_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('students', 'students_user_id_foreign');
        $this->db->query('ALTER TABLE students DROP CONSTRAINT IF EXISTS students_user_id_foreign;');

        $this->forge->dropColumn('students', 'user_id');
    }
}