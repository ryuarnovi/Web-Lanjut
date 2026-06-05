<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPoliToQueues extends Migration
{
    public function up()
    {
        if (!$this->db->fieldExists('poli', 'queues')) {
            $this->forge->addColumn('queues', [
                'poli' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'loket'],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('queues', 'poli');
    }
}
