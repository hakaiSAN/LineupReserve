<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class EndsController extends AppController
//誰でも閲覧できる
{
  public $uses = 'Events';

    //外部向け機能制限
    public function index()
    {
        $this->paginate = [
            'contain' => ['Stores']
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }



  //外部向け機能制限
    public function viewExternal($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Stores', 'Processions', 'Items']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

}
