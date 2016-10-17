<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="details index large-9 medium-8 columns content">
    <h3><?= __('Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $detail): ?>
            <tr>
                <td><?= $this->Number->format($detail->id) ?></td>
                <td><?= $detail->has('item') ? $this->Html->link($detail->item->name, ['controller' => 'Items', 'action' => 'view', $detail->item->id]) : '' ?></td>
                <td><?= $detail->has('order') ? $this->Html->link($detail->order->id, ['controller' => 'Orders', 'action' => 'view', $detail->order->id]) : '' ?></td>
                <td><?= $this->Number->format($detail->number) ?></td>
                <td><?= h($detail->created) ?></td>
                <td><?= h($detail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $detail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $detail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
