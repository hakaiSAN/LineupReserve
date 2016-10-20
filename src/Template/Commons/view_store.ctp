<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/commons'); ?>
</nav>
<div class="stores view large-9 medium-8 columns content">
    <h3><?= h($store->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('店舗名') ?></th>
            <td><?= h($store->name) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('開催イベント') ?></h4>
        <?php if (!empty($store->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('イベント名') ?></th>
                <th scope="col"><?= __('日付') ?></th>
                <th scope="col"><?= __('開催場所') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
            <?php foreach ($store->events as $events): ?>
            <tr>
                <td><?= h($events->name) ?></td>
                <td><?= h($events->date) ?></td>
                <td><?= h($events->location) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('開く'), ['action' => 'viewEvent', $events->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
