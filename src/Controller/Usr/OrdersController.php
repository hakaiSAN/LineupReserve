<?php
namespace App\Controller\Usr;

use App\Controller\AppController;
use App\Controller\SessionController;

use Cake\ORM\TableRegistry;
use Cake\Network\Exception\UnauthorizedException;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends SessionController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
/*
  public function index()
    {
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }
 */
  public function index()
    {
      $id = $this->Session->read("Customer.order");
      return $this->redirect(['action' => 'view', $id]);
    }

  /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Customers', 'Details']
        ]);
        $details =  TableRegistry::get('Details')->find('all', [
          'contain' => ['Items'],
          'conditions' => ['order_id' => $order->id]
        ]);
        $details = $details->toArray();
        $this->set('details', $details);
        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
/*
    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['customer_id'] = $this->Session->read('Customer.id');
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('order', 'customers'));
        $this->set('_serialize', ['order']);
    }
*/

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
/*
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
        $this->set(compact('order', 'customers'));
        $this->set('_serialize', ['order']);
    }
*/

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        //セッション情報を確認
        $action = $this->request->action; //どういった機能にいきたいかを検証
        if(in_array($action, ['view', 'edit', 'delete'])) {
            //要検討
            $customer_id =  $this->Session->read('Customer.id');
            $req_id = (int) $this->request->params['pass'][0];
            $preOrder = $this->Orders->get($req_id); //Order情報をpredict
            if($customer_id != $preOrder->customer_id){ //reqとloginユーザが等しいか
                throw new UnauthorizedException('許可されたページではありません');
            }
        }
        parent::beforeFilter($event);
    }

}
