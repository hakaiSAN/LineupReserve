<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Details'), ['controller' => 'Details', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Detail'), ['controller' => 'Details', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create(false) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php 
            echo $this->Html->script('jquery.min.js'); 
            echo $this->Html->script('additem.js'); 
        ?>
        <itemcol>アイテム1 </itemcol>
        <?php 
                echo $this->Form->input('items.' . 0 . '.name');
                echo $this->Form->input('items.' . 0 . '.price');
                echo $this->Form->input('items.' . 0 . '.stock');
                echo $this->Form->input('items.' . 0 . '.event_id', ['options' => $events]);
        ?>
        <itemcol>アイテム2 </itemcol>
        <?php 
                echo $this->Form->input('items.' . 1 . '.name');
                echo $this->Form->input('items.' . 1 . '.price');
                echo $this->Form->input('items.' . 1 . '.stock');
                echo $this->Form->input('items.' . 1 . '.event_id', ['options' => $events]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
