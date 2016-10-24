<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="side-nav", id="stores">
    <li class="heading"><?= __('リンク') ?></li>
    <li><?= $this->Html->link(__('一般サイトへ'), ['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]) ?> </li>
</ul>
</nav>
<div class="stores form large-9 medium-8 columns content">
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
<?= $this->Html->link('新規登録', ['action' => 'add'], array('class' => 'button')) ?>
</div>
