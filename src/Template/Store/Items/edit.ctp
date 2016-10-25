    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('商品編集') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => '商品名']);
            echo $this->Form->input('price',['label' => '価格']);
            echo $this->Form->input('stock', ['label' => '在庫数']);
            echo $this->Form->input('event_id', ['options' => $events]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $item->id], ['class' => 'button','confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
