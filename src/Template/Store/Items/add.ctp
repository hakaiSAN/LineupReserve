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
        <?php for ($count=0 ; $count < 10; $count++):
                echo $this->Form->input('items.' . $count . '.name');
                echo $this->Form->input('items.' . $count . '.price');
                echo $this->Form->input('items.' . $count . '.stock');
                echo $this->Form->input('items.' . $count . '.event_id', ['options' => $events]);
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
