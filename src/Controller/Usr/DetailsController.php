<?php
namespace App\Controller\Usr;

use App\Controller\AppController;

/**
 * Details Controller
 *
 * @property \App\Model\Table\DetailsTable $Details
 */
class DetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items', 'Orders']
        ];
        $details = $this->paginate($this->Details);

        $this->set(compact('details'));
        $this->set('_serialize', ['details']);
    }

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
        $detail = $this->Details->newEntity();
        if ($this->request->is('post')) {
            $detail = $this->Details->patchEntity($detail, $this->request->data);
            if ($this->Details->save($detail)) {
                $this->Flash->success(__('The detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The detail could not be saved. Please, try again.'));
            }
        }
        $items = $this->Details->Items->find('list', ['limit' => 200]);
        $orders = $this->Details->Orders->find('list', ['limit' => 200]);
        $this->set(compact('detail', 'items', 'orders'));
        $this->set('_serialize', ['detail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Detail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $detail = $this->Details->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $detail = $this->Details->patchEntity($detail, $this->request->data);
            if ($this->Details->save($detail)) {
                $this->Flash->success(__('The detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The detail could not be saved. Please, try again.'));
            }
        }
        $items = $this->Details->Items->find('list', ['limit' => 200]);
        $orders = $this->Details->Orders->find('list', ['limit' => 200]);
        $this->set(compact('detail', 'items', 'orders'));
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

        return $this->redirect(['action' => 'index']);
    }
}
