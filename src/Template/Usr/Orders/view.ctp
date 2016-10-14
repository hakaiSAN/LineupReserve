<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Details'), ['controller' => 'Details', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Detail'), ['controller' => 'Details', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orders view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $order->has('customer') ? $this->Html->link($order->customer->id, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paid') ?></th>
            <td><?= h($order->paid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($order->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Details') ?></h4>
        <?php if (!empty($order->details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Detail Id') ?></th>
                <th scope="col"><?= __('Item') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->details as $detail): ?>
            <tr>
                <td><?= h($detail->id) ?></td>
                <td>
                    <?php foreach($details as $tmp_detail) : ?> 
                        <?php if($tmp_detail->item->id == $detail->item_id) :?>
                            <?= h($tmp_detail->item->name) ?>
                        <?php endif; ?>
                    <?php endforeach; ?> 
                </td>
                <td><?= h($detail->number) ?></td>
                <td><?= h($detail->created) ?></td>
                <td><?= h($detail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Details', 'action' => 'view', $detail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Details', 'action' => 'edit', $detail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Details', 'action' => 'delete', $detail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
