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

use Cake\Controller\Controller;
use App\Controller\AppController;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AuthController extends AppController
{
    // 認証機能追加 


    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
//        $this->Auth->allow();
    }

  //アクセス制限機能
    public function isAuthorized($store = null) {
        $action = $this->request->action; //どういった機能にいきたいかを検証
        if(in_array($action, ['view', 'edit', 'delete'])) {
            //要検討
            $req_id = (int)$this->request->params['pass'][0];
            if($req_id == $store['id']){ //reqとloginユーザが等しいか
              return true;
            }
            return false; //みれない
        }
    }
}
