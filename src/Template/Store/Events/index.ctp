<h3><?= __('イベント一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('イベント名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('開催日') ?></th>
                <th scope="col"><?= $this->Paginator->sort('開催場所') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->date) ?></td>
                <td><?= h($event->location) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('確認'), ['action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $event->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('前ページ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次ページ') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
