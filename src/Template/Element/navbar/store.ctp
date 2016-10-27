    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">LineupReserve</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
            イベント
          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
                <?= $this->Html->link(__('開催イベント一覧'), ['controller' => 'Events', 'action' => 'index']) ?>
            </li>
            <li>
                <?= $this->Html->link(__('新規イベント作成'), ['controller' => 'Events', 'action' => 'add']) ?>
            </li>
          </ul><!-- /.Events-->
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
            商品
          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
                <?= $this->Html->link(__('販売商品一覧'), ['controller' => 'Items', 'action' => 'index']) ?>
            </li>
            <li>
                <?= $this->Html->link(__('販売商品作成'), ['controller' => 'Items', 'action' => 'add']) ?>
            </li>
          </ul><!-- /.Items-->
        </li>
        <li>
          <?= $this->Html->link(__('支払い・取引'), ['controller' => 'Payment', 'action' => 'check']) ?>
        </li>

      </ul><!-- /.navbar -->
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                <?= h($store->name) ?>
          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
            <?= $this->Html->link(__('店舗情報確認'), ['controller'=> 'Stores', 'action' => 'view', $store->id]) ?> 
            </li>
            <li>
            <?= $this->Html->link(__('店舗情報編集'), ['controller'=> 'Stores', 'action' => 'edit', $store->id]) ?>
            </li>
            <li>
                <?= $this->Form->postLink(__('ログアウト'), ['controller'=> 'Stores', 'action' => 'logout']) ?>
            </li>
            <li>
                <?= $this->Form->postLink(__('退会'), ['controller'=> 'Stores', 'action' => 'delete', $store->id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?>
            </li>
          </ul> 
        </li>
      </ul><!-- /.navbar-right -->
    </div><!-- /.nav-collapse -->

