<?php
namespace App\Controller\Usr;

use App\Controller\SessionController;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Network\Exception\NotFoundException;

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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Orders', 'Processions']
        ]);

        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
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
 public function lineup($secid = null)
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
        $event_id = $secid;
        $add_event = TableRegistry::get('Events')->get($event_id);//Event情報をpredict
      /*　ホントは存在しないExceptionのほうが望ましい
      if($add_event == null) {
          throw new NotFoundException('このイベントは存在しません');
      }
       */
        $customer = $this->Customers->newEntity();
        $customer = $this->Customers->patchEntity($customer, $this->request->data);
        if(!($this->Session->check('Customer.id'))){
            if($this->Customers->save($customer)){
                $this->Session->write('Customer.id', $customer->id);
//                debug($this->Session->read('Customer.id'));
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['controller' => 'Customers', 'action'=> 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
        } else {
            $this->autoRender = false;
            return $this->redirect(['controller' => 'Customers', 'action'=> 'index']);
        }
    }
    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
