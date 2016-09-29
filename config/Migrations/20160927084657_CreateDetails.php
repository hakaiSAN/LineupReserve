<?php
use Migrations\AbstractMigration;

class CreateDetails extends AbstractMigration
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
        $table = $this->table('details');
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('order_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('number', 'integer', [
            'default' => 0,
            'signed' => false,
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
        $table->addForeignKey('item_id', 'items', 'id', [
          'delete'  => 'NO_ACTION',
          'update'  => 'CASCADE',
        ]);
        $table->addForeignKey('order_id', 'orders', 'id', [
          'delete'  => 'NO_ACTION',
          'update'  => 'CASCADE',
        ]);
        $table->addIndex([
            'item_id',
        ], [
            'name' => 'BY_ITEM',
            'unique' => false,
        ]);
        $table->addIndex([
            'order_id',
        ], [
            'name' => 'BY_ORDER',
            'unique' => false,
        ]);
        $table->create();
    }
}
