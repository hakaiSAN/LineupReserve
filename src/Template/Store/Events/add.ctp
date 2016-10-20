<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Add Event') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'イベント名']);
            echo $this->Form->input('date', ['label' => '開催日']);
            echo $this->Form->input('location', ['label' => '開催場所']);
            echo $this->Form->hidden('store_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
