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
    <?= $this->Html->Link(__('編集'), ['action' => 'edit', $event->id], ['class' => 'button']) ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $event->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
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
                <td><?= $this->Number->format((array_key_exists($items->id, $reserves)) ? $reserves[$items->id] : 0) ?> / <?= $this->Number->format($items->stock) ?></td>
                <td class="itemactions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('編集'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
