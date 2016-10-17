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
    public function indexEvents()
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
    public function viewEvent($id = null)
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

    //外部向け機能制限
    public function indexStores()
    {
        $this->Stores= TableRegistry::get('Stores');
        $this->paginate = [
            'contain' => ['Events']
        ];
//        debug($this->paginate($this->Events));
        $stores= $this->paginate($this->Stores);

        $this->set(compact('stores'));
        $this->set('_serialize', ['stores']);
    }

  //外部向け機能制限
    public function viewStore($id = null)
    {
        $this->Stores= TableRegistry::get('Stores');
        $store= $this->Stores->get($id, [
            'contain' => ['Events']
          ]);
//        debug($reserves);
        $this->set('store', $store);
        $this->set('_serialize', ['store']);
    }

  //外部向け機能制限
    public function searchStores()
    {
      $this->Stores= TableRegistry::get('Stores');
      $stores = [];
    if ($this->request->is('post')) { 
        $search= $this->request->data['search'];
        $stores = $this->Stores->find('all', [
            'conditions' => ['name like' => '%'. $search. '%']
          ]);
    }
//        debug($reserves);
        $this->set('stores', $stores);
        $this->set('_serialize', ['store']);
    }
   
  //外部向け機能制限
    public function searchEvents()
    {
      $this->Stores= TableRegistry::get('Stores');
      $this->Events= TableRegistry::get('Events');
      $stores= $this->Stores->find('list',[
               'keyField' => 'id',
               'valueField' => 'name'
      ]); //店舗一覧を取得
      $events= [];
    if ($this->request->is('post')) { 
        $search= $this->request->data('search'); //name, date, location, storeが入力パラメータ
        debug($search); //name, date, location, storeが入力パラメータ
/*
        $events= $this->Events->find('all', [
            'contain' => ['Stores'],
            'conditions' => [
              'Events.name like' => '%'. $search['name'] . '%',
              'Events.date' => date($search['date']['year'].'-'.$search['date']['month'].'-'.$search['date']['day']),
                  'location' => $search['location'],
                  'store_id' => $search['store_id']
            ]
        ]);
    }
 */
        $condition = [];
        if(!$search['name'] == null) {
          $condition['Events.name like'] = '%'. $search['name'] . '%';
        } 
        if(!$search['date']['year'] == null && 
           !$search['date']['month'] == null && 
           !$search['date']['day'] == null) {
            $condition['Events.date'] = date($search['date']['year'].'-'.$search['date']['month'].'-'.$search['date']['day']);
        } 
        if(!$search['location'] == null) {
          $condition['Events.location'] = $search['location'];
        } 
        if(!$search['store_id'] == null) {
          $condition['Events.store_id'] = $search['store_id'];
        } 
//          debug($condition);
        $events= $this->Events->find('all', [
          'contain' => ['Stores'],
          'conditions' => $condition
        ]);
    }
        $this->set('stores', $stores);
        $this->set('events', $events);
        $this->set('_serialize', ['event']);
    }





}
