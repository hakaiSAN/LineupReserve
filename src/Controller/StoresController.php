<?php
namespace App\Controller;

use Cake\Auth\WeakPasswordHasher;
use App\Controller\AppController;

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 */
class StoresController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $stores = $this->paginate($this->Stores);

        $this->set(compact('stores'));
        $this->set('_serialize', ['stores']);
    }

    /**
     * View method
     *
     * @param string|null $id Store id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
    public function login()
    {
      if($this->request->is(['post'])) {
/*
        $testname = $this->request->data['loginname'];
        $testpass = $this->request->data['password'];
        debug($testname);
        debug($testpass);
 */
        $hasher = new WeakPasswordHasher();
        $bool = $hasher->hash($this->request->data['password']);
//        debug($bool);
//        $this->request->data['password'] = $bool;
        $user = $this->Auth->identify();
//        debug($this->Auth);
//        debug($this->request);
        if($user){
          $this->Auth->setUser($user);
          return $this->redirect($this->Auth->redirectUrl());
       } 
//        else{
            $this->Flash->error('ログインNameかパスワードが間違っています.');
//        }
      }
    }
    public function logout() {
      $this->redirect($this->Auth->logout());
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
//        $this->Auth->allow(['add', 'logout']);
        $this->Auth->allow();
//        $this->Auth->deny(['delete']);
    }
}
