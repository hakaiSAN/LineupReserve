    <div class="navbar-header">
      <a class="navbar-brand" href="#">LineupReserve</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <?= $this->Html->link(__('一般サイト'), ['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]) ?> </li>
        </li>
        <li>
          <?= $this->Html->link(__('店舗者サイト '), ['controller' => 'Stores', 'action' => 'login', 'prefix' => 'store']) ?>
        </li>
        <li>
          <?= $this->Html->link(__('イベント参加者サイト'), ['controller' => 'Customers', 'action'=>'view', 'prefix' => 'usr']) ?>
        </li>
      </ul>
    </div>

