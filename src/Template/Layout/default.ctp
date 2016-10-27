<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->prepend('css', $this->Html->css('offcanvas.css'));?>
    <?= $this->prepend('css', $this->Html->css('bootstrap.min.css'));?>
    <?= $this->prepend('script', $this->Html->script('offcanvas.js'));?>
    <?= $this->prepend('script', $this->Html->script('bootstrap.min.js'));?>
    <?= $this->prepend('script', $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'));?>
    <?= $this->prepend('script', $this->Html->script('ie10-viewport-bug-workaround.js'));?>
    <?= $this->prepend('less', $this->Less->less('less/grid.less'));?>
    <?= $this->prepend('less', $this->Less->less('less/grid-framework.less'));?>
    <?= $this->prepend('less', $this->Less->less('less/jumbotron.less'));?>
    <?= $this->prepend('less', $this->Less->less('less/variables.less'));?>
    <?= $this->prepend('less', $this->Less->less('less/vendor-prefixes.less'));?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('less') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<!-- カプセル化とprefixによる変更 -->
<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container" style="overflow:visible">
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
        <li class="active">
            <a href="#">Home</a>
        </li>
      <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
            Dropdown <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul> 
        </li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</nav><!-- /.navbar -->
    
<?= $this->Flash->render() ?>
    <div class="container clearfix">
        <div class="row-offcanvas row-offcanvas-right">
          <div class="large-9 medium-8 columns content">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">リンクリスト</button>
            </p>
            <!-- ページごとの設定呼び出し-->
            <?= $this->fetch('content') ?>
      </div>
    <!-- サイドバー-->
      <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <?php switch($this->request->prefix) :
            case 'usr' :
              echo $this->element('sidebar/usr');
              break;
            case 'store' :
              if($this->request->action == 'login' || 'add') {
                echo $this->element('sidebar/login');
              }
              else {
                echo $this->element('sidebar/store');
              }
              break;
            default:
              echo $this->element('sidebar/commons');
              break;
         endswitch; ?>
      </div>
    </div>
    <footer>
    </footer>
</body>
</html>
