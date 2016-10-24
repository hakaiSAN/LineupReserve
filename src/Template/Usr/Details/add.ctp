<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/usr'); ?>
</nav>
<div class="details form large-9 medium-8 columns content">
    <?= $this->Form->create(false) ?>
    <fieldset>
        <legend><?= __('注文受付') ?></legend>
        <?php for ($tmp=0 ; $tmp < $count; $tmp++):
                echo $this->Form->input('details.' . $tmp. '.item_id', ['label'=>'商品名', 'options' => $items, 'empty' => '商品を選んでください']);
//                echo $this->Form->input('details.' . $tmp. '.order_id', ['options' => $orders]);
                echo $this->Form->input('details.' . $tmp. '.number', ['label'=>'注文数', 'type' => 'number']);
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('注文する')) ?>
    <?= $this->Form->end() ?>
</div>
