    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('注文確認') ?></legend>
        <?php
            echo $this->Form->input('id', ['label' =>'注文番号'])
        ?>
    </fieldset>
    <?= $this->Form->button(__('確認')) ?>
    <?= $this->Form->end() ?>
