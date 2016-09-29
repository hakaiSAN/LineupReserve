<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Procession'), ['action' => 'edit', $procession->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Procession'), ['action' => 'delete', $procession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $procession->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Processions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Procession'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="processions view large-9 medium-8 columns content">
    <h3><?= h($procession->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $procession->has('customer') ? $this->Html->link($procession->customer->id, ['controller' => 'Customers', 'action' => 'view', $procession->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $procession->has('event') ? $this->Html->link($procession->event->id, ['controller' => 'Events', 'action' => 'view', $procession->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($procession->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($procession->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($procession->modified) ?></td>
        </tr>
    </table>
</div>
