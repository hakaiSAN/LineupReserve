<?php
use Migrations\AbstractMigration;

class AlterOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('orders');
        $table->changeColumn('paid', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->save();
    }
}
