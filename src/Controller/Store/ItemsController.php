<?php
namespace App\Controller\Store;

use App\Controller\AuthController;
use Cake\ORM\TableRegistry;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AuthController
{

  public function initialize(){
    parent::initialize();
    $this->itemable = TableRegistry::get('Items'); 
  }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events']
        ];
        $items = $this->paginate($this->Items);

        $this->set(compact('items'));
        $this->set('_serialize', ['items']);
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Events', 'Details']
        ]);
        $details = TableRegistry::get('Details');
        $mapper = $details->find('list',[
          'groupField' => 'item_id',
          'valueField' => 'number'
        ]);
        $mapper = $mapper->toArray();
//        debug($mapper);
        $reserves = null;
        foreach($mapper as $key => $value){
            $reserves[$key] = array_sum($value);
        } //合計値を計算
 //       debug($reserves);
        $this->set('reserves', $reserves);
        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemtable = TableRegistry::get('Items');
//        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $items = $itemtable->newEntities($this->request->data('items'));
            //            $item = $this->Items->patchEntity($item, $this->request->data);
            foreach($items as $item){
              if(!$item->errors()) {
                $this->Items->save($item);
                $this->Flash->success(__('The item has been saved.'));
              }
            }
            if($this->set('items', $items)){
//            if ($this->Items->save($item)) {
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item could not be saved. Please, try again.'));
            }
        }
        $events = $this->Items->Events->find('list',  [
          'keyField' => 'id',
          'valueField' => 'name',
          'conditions' => [ 'store_id' => $this->Auth->user('id')]
        ]);
        //        $this->set(compact('item', 'events'));
//        $this->set('_serialize', ['item']);
        $this->set(compact('items', 'events'));
        $this->set('_serialize', ['Items']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      /*
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
       */
      $item = $this->preItem;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item could not be saved. Please, try again.'));
            }
        }
        $events = $this->Items->Events->find('list', ['limit' => 200]);
        $this->set(compact('item', 'events'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        //$item = $this->Items->get($id);
        $item = $this->preItem;
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //アクセス制限機能 //Controllerごとに認証方法が異なるため再定義が必要
    public function isAuthorized() {
        $action = $this->request->action; //どういった機能にいきたいかを検証
        if(in_array($action, ['view', 'edit', 'delete'])) {
            $login_store_id =$this->Auth->user('id'); //ログインしている店舗IDを取得
            $req_id = (int)$this->request->params['pass'][0];
            $preItem = $this->Items->get($req_id, [ //Event情報をpredict
            'contain' => ['Events']
            ]);
            $req_store_id  = $preItem->event->store_id;
            if($req_store_id == $login_store_id){ //reqとloginユーザが等しいか
              return true;
            }
            return false; //一致していないので見れない
        }
        return true;
    }


}
