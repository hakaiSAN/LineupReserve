<?php
use Migrations\AbstractMigration;

class CreateProcessions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('processions');
        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey('customer_id', 'customers', 'id', [
          'delete'  => 'CASCADE',
          'update'  => 'CASCADE',
        ]);
        $table->addForeignKey('event_id', 'events', 'id', [
          'delete'  => 'NO_ACTION',
          'update'  => 'CASCADE',
        ]);
        $table->addIndex([
            'event_id',
        ], [
            'name' => 'BY_EVENT',
            'unique' => false,
        ]);
        $table->create();
    }
}
