<?php
namespace App\Controller\Store;

use App\Controller\AppController;
use App\Controller\AuthController;

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 */
class StoresController extends AuthController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      /*
        $stores = $this->paginate($this->Stores);

        $this->set(compact('stores'));
        $this->set('_serialize', ['stores']);
       */
      $this->redirect(['action' => 'view']);
    }

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id =$this->Auth->user('id'); //ログインしている店舗IDを取得
        $store = $this->Stores->get($id, [
            'contain' => ['Events']
        ]);

        $this->set('store', $store);
        $this->set('_serialize', ['store']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $store = $this->Stores->newEntity();
        if ($this->request->is('post')) {
            $store = $this->Stores->patchEntity($store, $this->request->data);
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The store could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('store'));
        $this->set('_serialize', ['store']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $store = $this->Stores->patchEntity($store, $this->request->data);
            if ($this->Stores->save($store)) {
                $this->Flash->success(__('The store has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The store could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('store'));
        $this->set('_serialize', ['store']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Stores->get($id);
        if ($this->Stores->delete($store)) {
            $this->Flash->success(__('The store has been deleted.'));
        } else {
            $this->Flash->error(__('The store could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    //認証機能
    public function login()
    {
      if($this->request->is(['post'])) {
            $store = $this->Auth->identify();
            if($store){
                $this->Auth->setUser($store);
                return $this->redirect($this->Auth->redirectUrl());
            } 
            else{
                $this->Flash->error('Nameかパスワードが間違っています.');
            }
      }
    }

    public function logout() {
      return $this->redirect($this->Auth->logout());
    }

// 本来はindexは誰にも見えない
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
//        $this->Auth->deny(['index']);
    }

    //アクセス制限機能 //Controllerごとに認証方法が異なるため再定義が必要
    public function isAuthorized($store = null) {
        $action = $this->request->action; //どういった機能にいきたいかを検証
        if(in_array($action, ['edit', 'delete'])) {
            //要検討
            $req_id = (int)$this->request->params['pass'][0];
            if($req_id == $store['id']){ //reqとloginユーザが等しいか
              return true;
            }
            return false; //一致していないので見れない
        }
        return true;
    }

}
