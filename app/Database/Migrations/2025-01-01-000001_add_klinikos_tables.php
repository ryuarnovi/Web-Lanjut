<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKlinikosTables extends Migration
{
    public function up()
    {
        // Add profile_picture_url to users (if not exists)
        if (!$this->db->fieldExists('profile_picture_url', 'users')) {
            $this->forge->addColumn('users', [
                'profile_picture_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'is_active'],
            ]);
        }

        // Add doctor_id, nurse_id, loket to queues (if not exists)
        if (!$this->db->fieldExists('doctor_id', 'queues')) {
            $this->forge->addColumn('queues', [
                'doctor_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'after' => 'created_by'],
            ]);
        }
        if (!$this->db->fieldExists('nurse_id', 'queues')) {
            $this->forge->addColumn('queues', [
                'nurse_id'  => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'after' => 'doctor_id'],
            ]);
        }
        if (!$this->db->fieldExists('loket', 'queues')) {
            $this->forge->addColumn('queues', [
                'loket'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'after' => 'nurse_id'],
            ]);
        }

        // doctor_schedules table
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'doctor_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'day_of_week'=> ['type' => 'TINYINT', 'constraint' => 1], // 0-6
            'start_time' => ['type' => 'TIME'],
            'end_time'   => ['type' => 'TIME'],
            'quota'      => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active'  => ['type' => 'BOOLEAN', 'default' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('doctor_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('doctor_schedules', true);

        // staff_shifts table
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'staff_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'shift_date' => ['type' => 'DATE'],
            'shift_type' => ['type' => 'VARCHAR', 'constraint' => 20], // morning, afternoon, night
            'start_time' => ['type' => 'TIME', 'null' => true],
            'end_time'   => ['type' => 'TIME', 'null' => true],
            'notes'      => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('staff_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('staff_shifts', true);

        // icd10 table
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'           => ['type' => 'VARCHAR', 'constraint' => 20],
            'description_en' => ['type' => 'TEXT', 'null' => true],
            'description_id' => ['type' => 'TEXT', 'null' => true],
            'is_active'      => ['type' => 'BOOLEAN', 'default' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('icd10', true);

        // icd9cm table
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'code'           => ['type' => 'VARCHAR', 'constraint' => 20],
            'description_en' => ['type' => 'TEXT', 'null' => true],
            'description_id' => ['type' => 'TEXT', 'null' => true],
            'is_active'      => ['type' => 'BOOLEAN', 'default' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('icd9cm', true);
    }

    public function down()
    {
        $this->forge->dropTable('icd9cm', true);
        $this->forge->dropTable('icd10', true);
        $this->forge->dropTable('staff_shifts', true);
        $this->forge->dropTable('doctor_schedules', true);

        $this->forge->dropColumn('queues', 'doctor_id');
        $this->forge->dropColumn('queues', 'nurse_id');
        $this->forge->dropColumn('queues', 'loket');
        $this->forge->dropColumn('users', 'profile_picture_url');
    }
}
