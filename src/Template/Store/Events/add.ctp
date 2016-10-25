<?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('イベント追加') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'イベント名']);
            echo $this->Form->input('date', ['label' => '開催日']);
            echo $this->Form->input('location', ['label' => '開催場所']);
            echo $this->Form->hidden('store_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
