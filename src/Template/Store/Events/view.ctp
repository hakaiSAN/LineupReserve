<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('イベント名') ?></th>
            <td><?= h($event->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('開催日') ?></th>
            <td><?= h($event->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('開催場所') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
<!--
        <tr>
            <th scope="row"><?= __('店舗名') ?></th>
            <td><?= $event->has('store') ? $this->Html->link($event->store->name, ['controller' => 'Stores', 'action' => 'view', $event->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($event->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($event->modified) ?></td>
        </tr>
-->
        <tr>
            <th scope="row"><?= __('行列') ?></th>
            <td><?= h($total) ?>人</td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('販売商品') ?></h4>
        <?php if (!empty($event->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('商品名') ?></th>
                <th scope="col"><?= __('価格') ?></th>
                <th scope="col"><?= __('在庫') ?></th>
                <th scope="col" class="itemactions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->items as $items): ?>
            <tr>
                <td><?= h($items->name) ?></td>
                <td>&yen;<?= $this->Number->format($items->price) ?></td>
                <td><?= $this->Number->format($reserves[$items->id]) ?> / <?= $this->Number->format($items->stock) ?></td>
                <td class="itemactions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
