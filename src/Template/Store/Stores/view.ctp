<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="stores view large-9 medium-8 columns content">
    <h3><?= h($store->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('店舗名') ?></th>
            <td><?= h($store->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= h($store->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('作成時刻') ?></th>
            <td><?= h($store->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('修正時刻') ?></th>
            <td><?= h($store->modified) ?></td>
        </tr>
    </table>
    <?= $this->Html->Link(__('編集'), ['action' => 'edit', $store->id], ['class' => 'button']) ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $store->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?>
    <div class="related">
        <h4><?= __('開催イベント') ?></h4>
        <?php if (!empty($store->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('ID') ?></th>
                <th scope="col"><?= __('イベント名') ?></th>
                <th scope="col"><?= __('開催日時') ?></th>
                <th scope="col"><?= __('開催場所') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
            <?php foreach ($store->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->name) ?></td>
                <td><?= h($events->date) ?></td>
                <td><?= h($events->location) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
                    <?= $this->Html->link(__('編集'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
