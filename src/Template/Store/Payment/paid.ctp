<div class="orders view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('注文番号') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('顧客番号') ?></th>
            <td><?= h($order->customer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('支払い') ?></th>
            <td><?= h($order->paid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('登録時刻') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('修正時刻') ?></th>
            <td><?= h($order->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('注文商品一覧') ?></h4>
        <?php if (!empty($order->details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('商品名') ?></th>
                <th scope="col"><?= __('価格') ?></th>
                <th scope="col"><?= __('注文数') ?></th>
            </tr>
            <?php foreach ($order->details as $detail): ?>
            <?php $sum = 0 ?>
            <tr>
                <td> <?= h($items[$detail->item_id]['name']) ?> </td>
                <td>&yen;<?= h($items[$detail->item_id]['price']) ?> </td>
                <td><?= h($detail->number) ?></td>
                <?php $sum = $sum + $items[$detail->item_id]['price'] * $detail->number ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <h4><?= __('合計金額') ?> &yen;<?= $this->Number->Format($sum) ?></h4>
        <?= $this->Form->create() ?>
        <?= ($states[$order->id] == "未払い") ?$this->Form->button('Paid') : null?>
        <?= $this->Form->end() ?>
    </div>
