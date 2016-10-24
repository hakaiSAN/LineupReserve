<?php
namespace App\Controller\Store;

use App\Controller\AppController;
use App\Controller\AuthController;

use Cake\ORM\TableRegistry;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AuthController
{

    public $components = ['Counting'];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($store = null)
    {
        $storeid =$this->Auth->user('id'); //ログインしている店舗IDを取得
        ;
        $this->paginate = [
            'contain' => ['Stores'],
            'conditions' => [ 'store_id' => $storeid]
        ];
        $events = $this->paginate($this->Events);
        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }


    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       //isAuthとはcontainが異なるため必要
      $event = $this->Events->get($id, [
            'contain' => ['Stores', 'Processions', 'Items']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
        $total = $this->Counting->processionAllCount($id);
        $reserves = $this->Counting->reserveAllCount();
        $this->set('reserves', $reserves);
        $this->set('total', $total);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['store_id'] = $this->Auth->user('id');
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $stores = $this->Events->Stores->find('list', ['limit' => 200]);
        $this->set(compact('event', 'stores'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      /*  
      $event = $this->Events->get($id, [
            'contain' => []
        ]);
       */
        $event = $this->preEvent;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['store_id'] = $this->Auth->user('id'); //店舗を付随
            $event = $this->Events->patchEntity($event, $this->request->data);
            debug($event);
            eval(breakpoint());
 
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $stores = $this->Events->Stores->find('list', ['limit' => 200]);
        $this->set(compact('event', 'stores'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
//        $event = $this->Events->get($id);
        $event = $this->preEvent;
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //アクセス制限機能 //Controllerごとに認証方法が異なるため再定義が必要
    public function isAuthorized() {
        $action = $this->request->action; //どういった機能にいきたいかを検証
        if(in_array($action, ['view', 'edit', 'delete'])) {
            $store_id =$this->Auth->user('id'); //ログインしている店舗IDを取得
            $req_id = (int)$this->request->params['pass'][0];
            $this->preEvent = $this->Events->get($req_id, [//Event情報をpredict
                'contain' => ['Stores']
            ]);
            if($this->preEvent->store->id == $store_id){ //reqとloginユーザが等しいか
              return true;
            }
            return false; //一致していないので見れない
        }
        return true;
    }

    
}
