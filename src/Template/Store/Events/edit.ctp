<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/stores'); ?>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->input('date');
            echo $this->Form->input('location');
//            echo $this->Form->input('store_id', ['options' => $stores]);
            echo $this->Form->hidden('store_id'); //Controller側で制御
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
