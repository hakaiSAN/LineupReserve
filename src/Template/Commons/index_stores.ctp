<h3><?= __('店舗一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('店舗名') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stores as $store): ?>
            <tr>
                <td><?= h($store->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('開く'), ['action' => 'viewStore', $store->id]) ?>
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
