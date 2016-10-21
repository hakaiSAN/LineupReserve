<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('イベント編集') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'イベント名']);
            echo $this->Form->input('date', ['label' => '開催日']);
            echo $this->Form->input('location', ['label' => '開催場所']);
            echo $this->Form->hidden('store_id'); //Controller側で制御
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $event->id], ['class' => 'button','confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
    <?= $this->Form->end() ?>
</div>
