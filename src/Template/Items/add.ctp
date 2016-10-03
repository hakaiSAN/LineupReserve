<?php 
    echo $this->Html->script('jquery.min.js');
    echo $this->Html->script('/jquery-ui-1.12.1.custom/jquery-ui-custom.min.js');
    ?>
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
        <legend><?= __('Add Item') ?></legend>

<div id="accordion">
   <div>
    <h3><a href="#">First</a></h3>
       <div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
   </div>
<div>
    <h3><a href="#">Second</a></h3>
       <div>Phasellus mattis tincidunt nibh.</div>
</div>
<div>
    <h3><a href="#">Third</a></h3>
       <div>Nam dui erat, auctor a, dignissim quis.</div>
</div>
</div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
