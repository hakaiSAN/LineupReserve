<ul class="side-nav", id="stores">
    <li class="heading"><?= __('リンク') ?></li>
    <li><?= $this->Html->link(__('店舗情報確認'), ['controller'=> 'Stores', 'action' => 'view', $store->id]) ?> </li>
    <li><?= $this->Html->link(__('店舗情報編集'), ['controller'=> 'Stores', 'action' => 'edit', $store->id]) ?> </li>
<br>
    <li><?= $this->Html->link(__('開催イベント一覧'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('新規イベント作成'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
<br>
    <li><?= $this->Html->link(__('販売商品一覧'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('販売商品作成'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
<br>
    <li><?= $this->Html->link(__('支払い・取引'), ['controller' => 'Payment', 'action' => 'check']) ?> </li>
    <li><?= $this->Form->postLink(__('ログアウト'), ['controller'=> 'Stores', 'action' => 'logout']) ?> </li>
    <li><?= $this->Form->postLink(__('退会'), ['controller'=> 'Stores', 'action' => 'delete', $store->id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?> </li>
</ul>

