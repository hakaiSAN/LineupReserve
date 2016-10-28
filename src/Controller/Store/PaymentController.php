<?php
namespace App\Controller\Store;

use App\Controller\AppController;
use App\Controller\AuthController;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 */
class PaymentController extends AuthController
{
    public $components = ['Associated'];
    public function check()
    {
        $this->Orders = TableRegistry::get('Orders'); 
        if ($this->request->is(['post'])) {
            $id = $this->request->data['id'];
            $check = $this->Orders->find('all', [
                'conditions' => ['id' => $id]
            ])->first();
            if (!$id == null && !$check == null) { //注文が存在
                return $this->redirect(['action' => 'paid', '0' => $id]);
            } else {
                $this->Flash->error(__('この注文は存在しません'));
            }
        }
    }

  public function paid($id = null)
    {
        //注文状況の確認
        $this->Orders = TableRegistry::get('Orders'); 
        $order = $this->Orders->get($id, [
            'contain' => ['Customers', 'Details']
        ]);
        $items = $this->Associated->ItemsNamePriceStock();
        $states = $this->Associated->stateOrders();
        
        if ($this->request->is(['post'])) {
          if($order->paid == null){
            $now = Time::now();
            $this->request->data['paid'] = $now;
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'check']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
          } else {
                $this->Flash->error(__('すでに取引が完了しています'));
          
          }
        }
        $this->set('states', $states);
        $this->set('items', $items);
        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }

    public function isAuthorized($store = null) {
        return true;
    }

}
