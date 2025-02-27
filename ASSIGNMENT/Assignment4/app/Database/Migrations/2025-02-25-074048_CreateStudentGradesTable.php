<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentGradesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'enrollment_id'=> [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned'=> true,
            ],
            'grade_value' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'unsigned' => true
            ],
            'grade_letter' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'completed_at'=> [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('enrollment_id', 'enrollments', 'id', 'CASCADE', 'CASCADE' );
        $this->forge->createTable('student_grades');
    }

    public function down()
    {
        $this->forge->dropTable('student_grades');
    }
}