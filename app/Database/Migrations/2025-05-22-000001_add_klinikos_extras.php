<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKlinikosExtras extends Migration
{
    public function up()
    {
        // Lokets table: dynamic service counters
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('lokets', true);

        // Suppliers table: vendor management for pharmacy
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'name'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'contact_person' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'          => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'address'        => ['type' => 'TEXT', 'null' => true],
            'notes'          => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('suppliers', true);

        // Stock transactions table: log every stock in/out movement
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'drug_id'     => ['type' => 'INT', 'null' => false],
            'type'        => ['type' => 'ENUM', 'constraint' => ['in', 'out'], 'default' => 'in'],
            'quantity'    => ['type' => 'INT', 'null' => false],
            'supplier_id' => ['type' => 'INT', 'null' => true],
            'batch_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'expiry_date' => ['type' => 'DATE', 'null' => true],
            'notes'       => ['type' => 'TEXT', 'null' => true],
            'created_by'  => ['type' => 'INT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('drug_id', 'drugs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('supplier_id', 'suppliers', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('stock_transactions', true);
    }

    public function down()
    {
        $this->forge->dropTable('stock_transactions', true);
        $this->forge->dropTable('suppliers', true);
        $this->forge->dropTable('lokets', true);
    }
}
