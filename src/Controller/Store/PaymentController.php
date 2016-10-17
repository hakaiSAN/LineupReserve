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
    public function check()
    {
        $this->Orders = TableRegistry::get('Orders'); 
        if ($this->request->is(['post'])) {
            $id = $this->request->data['id'];
            if (!$id == null) {
                return $this->redirect(['action' => 'paid', '0' => $id]);
            } else {
                $this->Flash->error(__('The order not exist, try again.'));
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
        $details =  TableRegistry::get('Details')->find('all', [
          'contain' => ['Items'],
          'conditions' => ['order_id' => $order->id]
        ]);
        
        if ($this->request->is(['post'])) {
            $now = Time::now();
            $this->request->data['paid'] = $now;
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'check']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $details = $details->toArray();
        $this->set('details', $details);
        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }

    public function isAuthorized($store = null) {
        return true;
    }

}
