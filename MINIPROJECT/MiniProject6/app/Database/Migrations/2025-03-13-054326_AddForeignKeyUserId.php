<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyUserId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users_profile', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'unique' => true,
                'null' => true
            ]
        ]);
         // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->db->query('ALTER TABLE users_profile ADD CONSTRAINT users_profile_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    }
    
    public function down()
    {
        // $this->forge->dropForeignKey('users_profile', 'users_profile_user_id_foreign');
        $this->db->query('ALTER TABLE users_profile DROP CONSTRAINT IF EXISTS users_profile_user_id_foreign;');
    
        $this->forge->dropColumn('users_profile', 'user_id');
    }
}