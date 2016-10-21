<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create(false) ?>
    <fieldset>
        <legend><?= __('販売商品追加') ?></legend>
        <?php for ($count=0 ; $count < 5; $count++):
                echo $this->Form->input('items.' . $count . '.name', ['label' => '【'.($count+1).'】'. '商品名']);
                echo $this->Form->input('items.' . $count . '.price', ['label' => '【'.($count+1).'】'. '価格', 'type' => 'number']);
                echo $this->Form->input('items.' . $count . '.stock', ['label' => '【'.($count+1).'】'. '在庫数', 'type' => 'number']);
                echo $this->Form->input('items.' . $count . '.event_id', ['label' => '【'.($count+1).'】'. 'イベント名', 'options' => $events]);
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
