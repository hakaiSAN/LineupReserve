<?php
namespace App\Controller\Usr;

use App\Controller\SessionController;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\UnauthorizedException;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends SessionController
//session管理なのでAuthじゃない
//class CustomersController extends AppController
//for debug
{
  public $components = ['Counting','Associated'];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
/* 見えない
  public function index()
    {
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }
*/ 
    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null)
    public function view()
    {
        $id =  $this->Session->read('Customer.id');
        $customer = $this->Customers->get($id, [
            'contain' => ['Orders', 'Processions']
        ]);
        $order_id =  $this->Session->check('Customer.order') ? $this->Session->read('Customer.order') : null ;
        $order = null;
        $items = null;
        if(!$order_id == null){ //orderが存在
            $order = TableRegistry::get('Orders')->find('all', [
                'contain' => ['Details'],
                'conditions' => ['Orders.id' => $order_id]
            ])->first(); //オーダ確認 ないとnull
            if (!$order == null && $order->customer_id == $id){ //正しい注文
              $items = $this->Associated->ItemsNamePriceStock();
            }
        } 
        $states = $this->Associated->stateOrders();
        $event_id = $this->Session->read('Customer.event');
        $event = TableRegistry::get('Events')->get($event_id); //確実に存在
        $total = $this->Counting->processionAllCount($event_id); //全体で何人並んでいるか
        $position = $this->Counting->processionOwnCount($event_id, $customer->modified); //自分は何番目か
        $ownItems = $this->Counting->reserveOwnCount($event_id, $customer->modified); //自分は何番目のアイテム注文か（key:item_id, value:注文数）
        $this->set('ownItems', $ownItems);
        $this->set('position', $position);
        $this->set('total', $total);
        $this->set('event', $event);
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
        $this->set('states', $states);
        $this->set('items', $items);
        $this->set('order', $order);
}

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     *
     */
/*
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }
*/
 public function lineup($id = null)
   //正しいIDのみユーザの追加と行列の追加
    {
/* //TODO: 暗号化チャレンジ
      $salt = Configure::read('salt');
        $eventkey = 'YQyEgAtRqx5BQiiVvihZhHjpPPJHZVRQ';
        $result = Security::encrypt('1', $eventkey, $salt);
        $event_id = Security::decrypt($secid, $eventkey, $salt);
        $this->log($result, LOG_DEBUG);
        $this->log($event_id, LOG_DEBUG);
 */ 
        $event_id = $id;
        $add_event = TableRegistry::get('Events')->get($event_id);//Event情報をpredict
      /*　ホントは存在しないExceptionのほうが望ましい
      if($add_event == null) {
          throw new NotFoundException('このイベントは存在しません');
      }
       */
        $customer = $this->Customers->newEntity();
        $customer = $this->Customers->patchEntity($customer, $this->request->data);
        if(!($this->Session->check('Customer.id'))){
          if($this->Customers->save($customer)) {
//            if($this->Customers->save($customer)){
                $this->Session->write('Customer.id', $customer->id);
                $this->Session->write('Customer.event', $id);
                return $this->redirect(['controller' => 'Customers','action'=> 'view']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
            $this->set(compact('customer'));
            $this->set('_serialize', ['customer']);
        } else {
//            $this->autoRender = false;
            return $this->redirect(['controller' => 'Customers', 'action'=> 'view']);
        }
    }
    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
/* 見えない
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }
 */
    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function delete($id = null)
    public function delete()
    {
        $id =  $this->Session->read('Customer.id');
//        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Session->destroy();
            $this->Flash->success(__('The customer has been deleted.'));
            return $this->redirect(['controller'=> 'Commons', 'action' => 'indexEvents', 'prefix' => false]);
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
            return $this->redirect(['controller'=> 'Customers', 'action' => 'view']);
        }
    }

    //権限の確認
/*
    public function beforeFilter(\Cake\Event\Event $event) {
        //セッション情報を確認
        $action = $this->request->action; //どういった機能にいきたいかを検証
//        if(in_array($action, ['view', 'edit', 'delete'])) {
        if(in_array($action, ['delete'])) {
            //要検討
            $customer_id =  $this->Session->read('Customer.id');
            $req_id = (int) $this->request->params['pass'][0];
            if($customer_id != $req_id){ //reqとloginユーザが等しいか
                throw new UnauthorizedException('許可されたページではありません');
            }
        }
        parent::beforeFilter($event);
    }
*/


}
