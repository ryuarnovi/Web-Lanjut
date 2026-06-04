<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisitTypeToQueues extends Migration
{
    public function up()
    {
        $this->forge->addColumn('queues', [
            'visit_type' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'default' => 'rawat_jalan', 'after' => 'poli'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('queues', 'visit_type');
    }
}
