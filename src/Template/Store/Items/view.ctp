<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('商品名') ?></th>
            <td><?= h($item->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('イベント名') ?></th>
            <td><?= $item->has('event') ? $this->Html->link($item->event->name, ['controller' => 'Events', 'action' => 'view', $item->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('価格') ?></th>
            <td>&yen;<?= $this->Number->format($item->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('在庫') ?></th>
            <td><?= $this->Number->format((array_key_exists($item->id, $reserves)) ? $reserves[$item->id] : 0) ?> / <?= $this->Number->format($item->stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('登録時刻') ?></th>
            <td><?= h($item->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('修正時刻') ?></th>
            <td><?= h($item->modified) ?></td>
        </tr>
    </table>
    <?= $this->Html->Link(__('編集'), ['action' => 'edit', $item->id], ['class' => 'button']) ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $item->id], ['class' => 'button','confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
    <div class="related">
        <h4><?= __('注文状況') ?></h4>
        <?php if (!empty($item->details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('注文番号') ?></th>
                <th scope="col"><?= __('顧客番号') ?></th>
                <th scope="col"><?= __('注文数') ?></th>
                <th scope="col"><?= __('状態') ?></th>
                <th scope="col" class="actions"><?= __('アクション') ?></th>
            </tr>
            <?php foreach ($item->details as $details): ?>
            <tr>
                <td><?= h($details->order_id) ?></td>
                <td><?= h($orders['customer'][$details->order_id]) ?></td>
                <td><?= $this->Number->format($details->number) ?></td>
                <td><?= h($orders['state'][$details->order_id]) ?></td>
                <td class="actions">
                    <?= ($orders['state'][$details->order_id] == "未払い") ? $this->Html->Link(__('支払い'), ['controller' => 'Payment', 'action' => 'paid', $details->order_id]) : null ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
