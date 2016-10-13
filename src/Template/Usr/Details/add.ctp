<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="details form large-9 medium-8 columns content">
    <?= $this->Form->create(false) ?>
    <fieldset>
        <legend><?= __('Add Detail') ?></legend>
        <?php for ($count=0 ; $count < 10; $count++):
                echo $this->Form->input('details.' . $count . '.item_id', ['options' => $items]);
//                echo $this->Form->input('details.' . $count . '.order_id', ['options' => $orders]);
                echo $this->Form->input('details.' . $count . '.number');
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
