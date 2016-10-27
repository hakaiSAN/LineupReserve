    <ul class "list-group">
      <li class="list-group-item active">
        一般サイトリンク
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('店舗一覧'), ['controller' => 'Commons', 'action' => 'indexStores']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('店舗検索'), ['controller' => 'Commons', 'action' => 'searchStores']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('イベント一覧'), ['controller' => 'Commons', 'action' => 'indexEvents']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('イベント検索'), ['controller' => 'Commons', 'action' => 'searchEvents']) ?>
      </li>
      <li class="list-group-item active">
        その他リンク
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('店舗者ページ'), ['controller' => 'Stores', 'action' => 'login', 'prefix' => 'store']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('イベント参加者ページ'), ['controller' => 'Customers', 'action'=>'view', 'prefix' => 'usr']) ?>
      </li>
    </ul>
