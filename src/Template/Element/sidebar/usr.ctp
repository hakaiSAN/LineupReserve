<ul class="side-nav", id="usr">
    <li class="heading"><?= __('リンク') ?></li>
    <li><?= $this->Html->link(__('ユーザ情報確認'), ['controller'=> 'Customers', 'action' => 'view']) ?> </li>
    <li><?= $this->Html->link(__('行列を抜ける'), ['controller'=> 'Customers', 'action' => 'delete']) ?> </li>
<br>
    <li><?= $this->Html->Link(__('一般サイトへ'), ['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]) ?> </li>
</ul>

