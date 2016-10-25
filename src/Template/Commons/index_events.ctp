<h3><?= __('イベント一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('イベント名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('開催場所') ?></th>
                <th scope="col"><?= $this->Paginator->sort('主催者') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->date) ?></td>
                <td><?= h($event->location) ?></td>
                <td><?= h($event->store->name) ?></td>
                <td><?= $this->Html->link(__('開く'), ['action' => 'viewEvent', $event->id]) ?></td>
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
