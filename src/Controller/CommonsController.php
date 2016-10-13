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
        $total = $processions->find('all',['conditions' => ['event_id' => $id]])->count();
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
//        debug($reserves);
        $this->set('reserves', $reserves);
        $this->set('event', $event);
        $this->set('total', $total);
        $this->set('_serialize', ['event']);
    }

}
