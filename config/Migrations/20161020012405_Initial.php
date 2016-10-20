<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('customers')
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('details')
            ->addColumn('item_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('order_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('number', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'item_id',
                ]
            )
            ->addIndex(
                [
                    'order_id',
                ]
            )
            ->create();

        $this->table('events')
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('location', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('store_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addIndex(
                [
                    'store_id',
                ]
            )
            ->create();

        $this->table('items')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('price', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('stock', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'event_id',
                ]
            )
            ->create();

        $this->table('orders')
            ->addColumn('customer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('paid', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'customer_id',
                ]
            )
            ->create();

        $this->table('processions')
            ->addColumn('customer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'customer_id',
                ]
            )
            ->addIndex(
                [
                    'event_id',
                ]
            )
            ->create();

        $this->table('stores')
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('details')
            ->addForeignKey(
                'item_id',
                'items',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'order_id',
                'orders',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('events')
            ->addForeignKey(
                'store_id',
                'stores',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('items')
            ->addForeignKey(
                'event_id',
                'events',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('orders')
            ->addForeignKey(
                'customer_id',
                'customers',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('processions')
            ->addForeignKey(
                'customer_id',
                'customers',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'event_id',
                'events',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('details')
            ->dropForeignKey(
                'item_id'
            )
            ->dropForeignKey(
                'order_id'
            );

        $this->table('events')
            ->dropForeignKey(
                'store_id'
            );

        $this->table('items')
            ->dropForeignKey(
                'event_id'
            );

        $this->table('orders')
            ->dropForeignKey(
                'customer_id'
            );

        $this->table('processions')
            ->dropForeignKey(
                'customer_id'
            )
            ->dropForeignKey(
                'event_id'
            );

        $this->dropTable('customers');
        $this->dropTable('details');
        $this->dropTable('events');
        $this->dropTable('items');
        $this->dropTable('orders');
        $this->dropTable('processions');
        $this->dropTable('stores');
    }
}
