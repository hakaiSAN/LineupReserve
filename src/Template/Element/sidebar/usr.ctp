<ul class="side-nav", id="usr">
    <li class="heading"><?= __('リンク') ?></li>
    <li><?= $this->Html->link(__('ユーザ情報・注文状況'), ['controller'=> 'Customers', 'action' => 'view']) ?> </li>
    <li><?= $this->Html->link(__('並ぶのを止める'), ['controller'=> 'Customers', 'action' => 'delete'], ['confirm' => __('Are you sure you want to delete ?')]) ?> </li>
<br>
    <li><?= $this->Html->link(__('注文を行う'), ['controller'=> 'Details', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('注文を編集する'), ['controller'=> 'Details', 'action' => 'edit']) ?> </li>

<br>
    <li><?= $this->Html->Link(__('一般サイトへ'), ['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]) ?> </li>
</ul>

