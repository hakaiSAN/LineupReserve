    <ul class "list-group">
      <li class="list-group-item active">
        イベント参加者リンク
      </li>
      <li class="list-group-item">
         <?= $this->Html->link(__('ユーザ情報・注文状況'), ['controller'=> 'Customers', 'action' => 'view']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('並ぶのを止める'), ['controller'=> 'Customers', 'action' => 'delete'], ['confirm' => __('Are you sure you want to delete ?')]) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('注文を行う'), ['controller'=> 'Details', 'action' => 'add']) ?>
      </li>
      <li class="list-group-item">
        <?= $this->Html->link(__('注文を編集する'), ['controller'=> 'Details', 'action' => 'edit']) ?>
      </li>
      <li class="list-group-item active">
        その他リンク
      </li>
      <li class="list-group-item">
        <?= $this->Html->Link(__('一般サイト'), ['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]) ?>
      </li>
    </ul>

