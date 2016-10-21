    <ul class="side-nav", id="commons">
        <li class="heading"><?= __('リンク') ?></li>
        <li><?= $this->Html->link(__('店舗一覧'), ['controller' => 'Commons', 'action' => 'indexStores']) ?></li>
        <li><?= $this->Html->link(__('店舗検索'), ['controller' => 'Commons', 'action' => 'searchStores']) ?></li>
<br>
        <li><?= $this->Html->link(__('イベント一覧'), ['controller' => 'Commons', 'action' => 'indexEvents']) ?></li>
        <li><?= $this->Html->link(__('イベント検索'), ['controller' => 'Commons', 'action' => 'searchEvents']) ?></li>
<br>
        <li><?= $this->Html->link(__('店舗者ログイン'), ['controller' => 'Stores', 'action' => 'login', 'prefix' => 'store']) ?></li>
        <li><?= $this->Html->link(__('イベント参加者ページへ'), ['controller' => 'Customers', 'action'=>'view', 'prefix' => 'usr']) ?></li>
    </ul>

