    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('店舗ログイン') ?></legend>
        <?php
            echo $this->Form->input('name', ['label'=>'店舗名']);
            echo $this->Form->input('password', ['label'=>'パスワード']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')) ?>
    <?= $this->Form->end() ?>
    <br>
<?= $this->Html->link('新規登録', ['action' => 'add'], array('class' => 'button')) ?>
