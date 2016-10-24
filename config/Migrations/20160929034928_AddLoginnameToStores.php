<?php
use Migrations\AbstractMigration;

class AddLoginnameToStores extends AbstractMigration
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
        $table = $this->table('stores');
//        $table->addColumn('loginname', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => false,
//        ]);
        $table->renameColumn('pass', 'password');
        $table->update();
    }
}
