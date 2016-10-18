<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'indexEvents']) ?> </li>
    </ul>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($event->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($event->date) ?></td>
        </tr>
       <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th scope="row" class="action"><?= __('Store') ?></th>
            <td><?= $this->Html->link($event->store->name, ['action'=> 'viewStore', $event->store->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Procession') ?></th>
            <td><?= h($total) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($event->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Stock') ?></th>
                <th scope="col"><?= __('Reserved') ?></th>
            </tr>
            <?php foreach ($event->items as $item): ?>
            <tr>
                <td><?= h($item->name) ?></td>
                <td><?= h($item->price) ?></td>
                <td><?= h($item->stock) ?></td>
                <td><?= h($reserves[$item->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>