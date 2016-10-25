    <ul class "list-group">
      <li class="list-group-item active">
        店舗用リンク
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('店舗情報確認'), ['controller'=> 'Stores', 'action' => 'view', $store->id]) ?> 
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('店舗情報編集'), ['controller'=> 'Stores', 'action' => 'edit', $store->id]) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('開催イベント一覧'), ['controller' => 'Events', 'action' => 'index']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('新規イベント作成'), ['controller' => 'Events', 'action' => 'add']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('販売商品一覧'), ['controller' => 'Items', 'action' => 'index']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('販売商品作成'), ['controller' => 'Items', 'action' => 'add']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('支払い・取引'), ['controller' => 'Payment', 'action' => 'check']) ?>
      </li>
    
      <li class="list-group-item active">
        その他リンク
      </li>
      <li class="list-group-item">
        <?= $this->Form->postLink(__('ログアウト'), ['controller'=> 'Stores', 'action' => 'logout']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Form->postLink(__('退会'), ['controller'=> 'Stores', 'action' => 'delete', $store->id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?>
      </li>
    </ul>
