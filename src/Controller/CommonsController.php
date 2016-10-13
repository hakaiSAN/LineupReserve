<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;



/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CommonsController extends AppController
//誰でも閲覧できる
{

    //外部向け機能制限
    public function index()
    {
        $this->Events = TableRegistry::get('Events');
        $this->paginate = [
            'contain' => ['Stores']
        ];
//        debug($this->paginate($this->Events));
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

  //外部向け機能制限
    public function view($id = null)
    {
        $this->Events = TableRegistry::get('Events');
        $event = $this->Events->get($id, [
            'contain' => ['Stores', 'Processions', 'Items']
          ]);
        $processions = TableRegistry::get('Processions');
//        $total = $processions->find('count',['condition' [$processions.id => $id]]);
        $total = $processions->find('all',['conditions' => ['event_id' => $id]])->count();
        $this->set('event', $event);
        $this->set('total', $total);
        $this->set('_serialize', ['event']);
    }

}
