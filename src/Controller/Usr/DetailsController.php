<?php
namespace App\Controller\Usr;

use App\Controller\AppController;
use App\Controller\SessionController;

use Cake\ORM\TableRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\UnauthorizedException;


/**
 * Details Controller
 *
 * @property \App\Model\Table\DetailsTable $Details
 */
class DetailsController extends SessionController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
  /*
    public function index()
    {
        $customer_id = $this->Session->read('Customer.id');
        $this->paginate = [
            'contain' => ['Items', 'Orders'],
            'conditions' => [ 'customer_id' => $customer_id]
        ];
        $details = $this->paginate($this->Details);

        $this->set(compact('details'));
        $this->set('_serialize', ['details']);
    }
   */
    /**
     * View method
     *
     * @param string|null $id Detail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $detail = $this->Details->get($id, [
            'contain' => ['Items', 'Orders']
        ]);

        $this->set('detail', $detail);
        $this->set('_serialize', ['detail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $detailtable = TableRegistry::get('Details');
        $order = null;
//        $detail = $this->Details->newEntity();
//        if ($this->request->is('post') && !($this->Session->check('Customer.order'))) { //まだ発注していない
        if ($this->request->is('post')) { //まだ発注していない
        $details = $detailtable->newEntities($this->request->data('details'));
            $details = $detailtable->PatchEntities($details, $this->request->data('details'));
            $details = $this->_uniqueData($details); //同じ商品は2回発注できない
            foreach($details as $detail){
                if(!$detail->errors()) {
                    //order発行
                    if($order == null){
                        $orders = TableRegistry::get('Orders');
                        $order = $orders->newEntity();
                        $req_data['customer_id'] = $this->Session->read('Customer.id');
                        $req_data['paid'] = null;
                        $order = $orders->patchEntity($order, $req_data);

                        if (!$orders->save($order)) {
                          throw new InternalErrorException;
                          //エラー発生 
                        }
                    } 
//            $detail = $this->Details->patchEntity($detail, $this->request->data);
                        $detail['order_id'] = $order->id;
                        $this->Details->save($detail);
                        $this->Flash->success(__('The detail has been saved.'));
                    }
            }
//            if ($this->Details->save($detail)) {
                if($this->set('details', $details)){
                    $this->Session->write('Customer.order', $order->id); //二回発注しないようにする　編集のみ
                    return $this->redirect(['controller'=>'Customers', 'action' => 'view']);
                } else {
                    $this->Flash->error(__('The detail could not be saved. Please, try again.'));
                }
            }
//        else { //編集のみ
//            $id = $this->Session->read("Customer.order");
//            return $this->redirect(['controller' => 'Orders', 'action' => 'view', $id]);
//        }
        $items = $this->Details->Items->find('list', [
          'keyField' => 'id',
          'valueField' => 'name',
          'conditions' => [ 'event_id' => $this->Session->read('Customer.event')]
        ]);
        $count = count($items->toArray()); //アイテム数の登録監視
        $this->set('count', $count);
        //order番号は自動的に付与
//        $orders = $this->Details->Orders->find('list', ['limit' => 200]);
        $this->set(compact('details', 'items'));
        $this->set('_serialize', ['detail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Detail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
        public function edit()
    {
        $order_id = $this->Session->read("Customer.order");
        $detailtable = TableRegistry::get('Details');
//        $details =  $detailtable->find('all');
        $details =  $detailtable->find('all', [
          'conditions' => ['order_id' => $order_id]
        ]);//自分の注文情報が一括で出てくる
        $details = $details->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $details = $detailtable->patchEntities($details, $this->request->data());
            $details = $this->_uniqueData($details); //同じ商品は2回発注できない
            foreach($details as $detail){
                if(!$detail->errors()) {
                        $detail['order_id'] = $order_id;
                        $this->Details->save($detail);
                    }
            }
            if($this->set('details', $details)){
                $this->Flash->success(__('The details have been saved.'));
                    return $this->redirect(['controller'=>'Customers', 'action' => 'view']);
            } else {
                $this->Flash->error(__('The detail could not be saved. Please, try again.'));
            }
        }
        $items = $this->Details->Items->find('list', [
          'keyField' => 'id',
          'valueField' => 'name',
          'conditions' => [ 
            'event_id' => $this->Session->read('Customer.event')
          ]
        ]);
        $count = count($items->toArray()); //アイテム数の登録監視
        $this->set('count', $count);
        $this->set(compact('details', 'items'));
        $this->set('_serialize', ['detail']);
    }
    
        /**
     * Delete method
     *
     * @param string|null $id Detail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $detail = $this->Details->get($id);
        if ($this->Details->delete($detail)) {
            $this->Flash->success(__('The detail has been deleted.'));
        } else {
            $this->Flash->error(__('The detail could not be deleted. Please, try again.'));
        }
                    return $this->redirect(['controller'=>'Customers', 'action' => 'view']);
    }

    //権限の確認
    public function beforeFilter(\Cake\Event\Event $event) {
        //セッション情報を確認
        $action = $this->request->action; //どういった機能にいきたいかを検証
//        if(in_array($action, ['view', 'edit', 'delete'])) {
        if(in_array($action, ['view', 'delete'])) {
            //要検討
            $customer_id =  $this->Session->read('Customer.id');
            $req_id = (int) $this->request->params['pass'][0];
            $preDetail = $this->Details->get($req_id, [//Details情報をpredict
                'contain' => ['Orders']
            ]);
            if($customer_id != $preDetail->order->customer_id){ //reqとloginユーザが等しいか
                throw new UnauthorizedException('許可されたページではありません');
            }
        }
        parent::beforeFilter($event);
    }

    public function _uniqueData($details){
            $tmp = []; //
            $unique = []; //ダブりなし
            foreach($details as $detail){
              if(!in_array($detail->item_id, $tmp, true)) {
                    $tmp[] = $detail['item_id'];
                    $unique[] = $detail;
              }
            } 
            return $unique; 
    }



}
