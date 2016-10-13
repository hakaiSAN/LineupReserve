<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Processions Controller
 *
 * @property \App\Model\Table\ProcessionsTable $Processions
 */
class ProcessionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Events']
        ];
        $processions = $this->paginate($this->Processions);

        $this->set(compact('processions'));
        $this->set('_serialize', ['processions']);
    }

    /**
     * View method
     *
     * @param string|null $id Procession id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $procession = $this->Processions->get($id, [
            'contain' => ['Customers', 'Events']
        ]);

        $this->set('procession', $procession);
        $this->set('_serialize', ['procession']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
/*
    public function add($id = null)
    {
        $procession = $this->Processions->newEntity();
//        if ($this->request->is('post')) {
          if(($id == null) || !($this->request->session()->check('Customer.id'))){
                //Error
                throw new NotFoundException('このイベントは存在しません');
          }
          $this->request->data['event_id'] = $id;
          $this->request->data['customer_id'] = $this->request->session()->read('Customer.id');
            $procession = $this->Processions->patchEntity($procession, $this->request->data);
            if ($this->Processions->save($procession)) {
                $this->Flash->success(__('The procession has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The procession could not be saved. Please, try again.'));
            }
//        }
        $customers = $this->Processions->Customers->find('list', ['limit' => 200]);
        $events = $this->Processions->Events->find('list', ['limit' => 200]);
        $this->set(compact('procession', 'customers', 'events'));
        $this->set('_serialize', ['procession']);
    }
 */
    /**
     * Edit method
     *
     * @param string|null $id Procession id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $procession = $this->Processions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $procession = $this->Processions->patchEntity($procession, $this->request->data);
            if ($this->Processions->save($procession)) {
                $this->Flash->success(__('The procession has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The procession could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Processions->Customers->find('list', ['limit' => 200]);
        $events = $this->Processions->Events->find('list', ['limit' => 200]);
        $this->set(compact('procession', 'customers', 'events'));
        $this->set('_serialize', ['procession']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Procession id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $procession = $this->Processions->get($id);
        if ($this->Processions->delete($procession)) {
            $this->Flash->success(__('The procession has been deleted.'));
        } else {
            $this->Flash->error(__('The procession could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
