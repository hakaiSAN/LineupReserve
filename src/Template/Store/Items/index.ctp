    <h3><?= __('販売商品一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('名前') ?></th>
                <th scope="col"><?= $this->Paginator->sort('イベント名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('価格') ?></th>
                <th scope="col"><?= $this->Paginator->sort('予約/在庫') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= h($item->name) ?></td>
                <td><?= $item->has('event') ? $this->Html->link($item->event->name, ['controller' => 'Events', 'action' => 'view', $item->event->id]) : '' ?></td>
                <td>&yen;<?= $this->Number->format($item->price) ?></td>
                <td><?= $this->Number->format((array_key_exists($item->id, $reserves)) ? $reserves[$item->id] : 0) ?> / <?= $this->Number->format($item->stock) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['action' => 'view', $item->id]) ?>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $item->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
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
