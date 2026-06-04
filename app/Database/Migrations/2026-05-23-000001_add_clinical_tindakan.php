<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddClinicalTindakan extends Migration
{
    public function up()
    {
        // Add icd9_code and tindakan_fee to medical_records
        $this->forge->addColumn('medical_records', [
            'icd9_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'icd_code'
            ],
            'tindakan_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'icd9_code'
            ],
        ]);

        // Add tindakan_fee to payments
        $this->forge->addColumn('payments', [
            'tindakan_fee' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'doctor_fee'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('payments', 'tindakan_fee');
        $this->forge->dropColumn('medical_records', 'tindakan_fee');
        $this->forge->dropColumn('medical_records', 'icd9_code');
    }
}
