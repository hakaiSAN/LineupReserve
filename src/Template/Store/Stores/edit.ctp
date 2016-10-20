<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="stores form large-9 medium-8 columns content">
    <?= $this->Form->create($store) ?>
    <fieldset>
        <legend><?= __('店舗情報編集') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => '店舗名']);
            echo $this->Form->input('password', ['label' => 'パスワード']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
</div>
