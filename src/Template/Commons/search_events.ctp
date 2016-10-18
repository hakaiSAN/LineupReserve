<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['action' => 'indexStores']) ?></li>
    </ul>
</nav>
<div class="events index large-9 medium-8 columns content">
    <h3><?= __('Search Events') ?></h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
            echo $this->Form->input('search.name');
            echo $this->Form->input('search.date', ['type' =>'date', 'empty' => '---']);
            echo $this->Form->input('search.location');
            echo $this->Form->input('search.store_id', ['options' => $stores, 'empty' => '---']);
        ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </fieldset>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col" class="actions"><?= __('View') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->date) ?></td>
                <td><?= h($event->location) ?></td>
                <td><?= h($event->store->name) ?></td>
                <td><?= $this->Html->link(__('View'), ['action' => 'viewEvent', $event->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>