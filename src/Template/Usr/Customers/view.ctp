<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/usr'); ?>
</nav>
<div class="customers view large-9 medium-8 columns content">
    <h3>ユーザ情報</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($customer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('登録時刻') ?></th>
            <td><?= h($customer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('イベント名') ?></th>
            <td><?= $this->Html->link($event->name, ['prefix' => false, 'controller' => 'Commons', 'action' => 'viewEvent', $event->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('行列情報：自分/全体') ?></th>
            <td><?= h($position) . '/' . h($total) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('注文状況') ?></h4>
        <?php if ($order == null): ?>
            <br>
        <h4><?= __('まだ注文していません') ?></h4>
        <?php else : ?>
        <h4><?= h($states[$order->id]) ?></h4>
        <?php if (!empty($order->details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('商品名') ?></th>
                <th scope="col"><?= __('価格') ?></th>
                <th scope="col"><?= __('注文数') ?></th>
            </tr>
            <?php $sum = 0 ?>
            <?php foreach ($order->details as $detail): ?>
            <tr>
                <td> <?= h($items[$detail->item_id]['name']) ?> </td>
                <td>&yen;<?= $this->Number->Format($items[$detail->item_id]['price']) ?> </td>
                <td><?= $this->Number->Format($detail->number) ?></td>
                <?php $sum = $sum + $items[$detail->item_id]['price'] * $detail->number ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <h4><?= __('合計金額') ?> &yen;<?= $this->Number->Format($sum) ?></h4>
        <?php endif; ?>
    </div>
</div>
