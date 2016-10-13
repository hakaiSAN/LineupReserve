<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
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
            <th scope="row"><?= __('Store') ?></th>
            <td><?= h($event->store->name) ?></td>
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
                <th scope="col" class="itemactions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->items as $items): ?>
            <tr>
                <td><?= h($items->name) ?></td>
                <td><?= h($items->price) ?></td>
                <td><?= h($items->stock) ?></td>
                <td>これから</td>
                <td class="itemactions">
                    予約する
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
