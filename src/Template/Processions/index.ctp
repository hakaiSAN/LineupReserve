<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Procession'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="processions index large-9 medium-8 columns content">
    <h3><?= __('Processions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($processions as $procession): ?>
            <tr>
                <td><?= $this->Number->format($procession->id) ?></td>
                <td><?= $procession->has('customer') ? $this->Html->link($procession->customer->id, ['controller' => 'Customers', 'action' => 'view', $procession->customer->id]) : '' ?></td>
                <td><?= $procession->has('event') ? $this->Html->link($procession->event->id, ['controller' => 'Commons', 'action' => 'view', $procession->event->id]) : '' ?></td>
                <td><?= h($procession->created) ?></td>
                <td><?= h($procession->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $procession->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $procession->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $procession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $procession->id)]) ?>
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
