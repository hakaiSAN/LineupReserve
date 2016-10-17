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
    <?= $this->Form->create($details) ?>
    <fieldset>
        <legend><?= __('Edit Detail') ?></legend>
        <?php 
            foreach ($details as $key => $detail): 
              echo $this->Form->hidden($key .'.id', ['value'=>$detail['id']]);
              echo $this->Form->input($key .'.item_id', ['options' => $items, 'value'=>$detail['item_id'], 'disabled'=>'disabled']);
              echo $this->Form->input($key.'.number', ['value'=>$detail['number']]);
            endforeach;
              for($key = $key+1; $key < $count; $key++) : //追加分
                echo $this->Form->input($key .'.item_id', ['options' => $items]);
                echo $this->Form->input($key.'.number');
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
