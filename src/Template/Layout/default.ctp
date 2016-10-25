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
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Project name</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->
<!--
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
-->
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
