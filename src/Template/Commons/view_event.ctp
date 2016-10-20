<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/commons'); ?>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('開催日') ?></th>
            <td><?= h($event->date) ?></td>
        </tr>
       <tr>
            <th scope="row"><?= __('開催場所') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th scope="row" class="action"><?= __('店舗名') ?></th>
            <td><?= $this->Html->link($event->store->name, ['action'=> 'viewStore', $event->store->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('待っている人') ?></th>
            <td><?= h($total) ?></td>
        </tr>
    </table>
    ※待っている人の数と商品予約数は <br>
    <?= h($nowtime) ?>  のものです。
    <div class="related">
        <h4><?= __('販売商品') ?></h4>
        <?php if (!empty($event->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('商品名') ?></th>
                <th scope="col"><?= __('価格') ?></th>
                <th scope="col"><?= __('在庫数') ?></th>
                <th scope="col"><?= __('予約数') ?></th>
            </tr>
            <?php foreach ($event->items as $item): ?>
            <tr>
                <td><?= h($item->name) ?></td>
                <td><?= h($item->price) ?></td>
                <td><?= h($item->stock) ?></td>
                <td><?= h($reserves[$item->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
