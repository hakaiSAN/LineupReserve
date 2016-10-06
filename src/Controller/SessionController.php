<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class SessionController extends AppController
{
        public function initialize()
        {
            parent::initialize();
            $this->Session = $this->request->session();
        }
    
        // セッション確認機能追加  //全ページ不許可 Controllerごとにallowで制限
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        //セッション情報を確認
         if(!($this->Session->check('Customer.id')) && !($this->Session->check('Customer.status'))){ //2回呼び出すのをふせぐ
           $this->Session->write('Customer.status','1'); //呼び出す前に書き込み状態
            $this->redirect(['controller' => 'Customers', 'action'=> 'addSession']);
        }
    }
}
