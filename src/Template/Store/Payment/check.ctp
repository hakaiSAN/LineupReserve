<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="stores form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('注文確認') ?></legend>
        <?php
            echo $this->Form->input('id', ['label' =>'注文番号'])
        ?>
    </fieldset>
    <?= $this->Form->button(__('確認')) ?>
    <?= $this->Form->end() ?>
</div>
