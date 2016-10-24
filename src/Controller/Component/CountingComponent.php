<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class CountingComponent extends Component {
    //行列の全員を数える
     public function processionAllCount($event_id) {
        $processions = TableRegistry::get('Processions');
        $total = $processions->find('all',['conditions' => ['event_id' => $event_id]])->count();
        return $total;
     }
     public function processionOwnCount($event_id, $modified) {
        $processions = TableRegistry::get('Processions');
        $position = $processions->find('all', [
          'conditions' => [
            'modified <'  => $modified,
            'event_id'  => $event_id
          ]
        ])->count() + 1; //自分は何番目か
        return $position;
     }
     //全商品の予約数を数える
     public function reserveAllCount(){
        $details = TableRegistry::get('Details');
        $mapper = $details->find('list',[
          'groupField' => 'item_id',
          'valueField' => 'number'
        ]);
        $mapper = $mapper->toArray();
//        debug($mapper);
        $reserves = [];
        foreach($mapper as $key => $value){
            $reserves[$key] = array_sum($value);
        } //合計値を計算
//        debug($reserves);
        return $reserves; 
     }
    //自分の商品が何番目かを数える
     public function reserveOwnCount($event_id, $modified){ //自分の注文番号
        $processions= TableRegistry::get('Processions')->find('all', [
          'conditions' => [
            'modified <'  => $modified,
            'event_id'  => $event_id
          ]
        ])->toArray(); //これで自分より前のcustomer_idがわかる
//        debug($processions);
        $orders = TableRegistry::get('Orders');
        $orders_tmp =$orders->find('list',[
          'keyField' => 'customer_id',
          'valueField' => 'id'
        ])->toArray(); //1人1回しか注文できないので固有のはず
//        debug($orders_tmp);
        $orders_mapper=[];
        foreach($processions as $procession){
          if(isset($orders_tmp[$procession->customer_id])){
            $orders_mapper[$procession->customer_id] = $orders_tmp[$procession->customer_id];
          }
        } //自分より前の人のmapper(key:customer_id value:order_id)ができる
        $details = TableRegistry::get('Details');
        $details_tmp= $details->find('list',[
          'groupField' => 'item_id',
          'keyField' => 'order_id',
          'valueField' => 'number'
        ])->toArray();
        $details_tmp2= $details->find('list',[
          'keyField' => 'order_id',
          'valueField' => 'item_id'
        ])->toArray();
        $mapper=[];
        if(!empty($orders_mapper)){
        foreach($orders_mapper as $key => $value){ 
          foreach($details_tmp as $map_key => $map_value){
            //mapper[items_id][order_id] = numberの構造
            if(!empty($details_tmp[$map_key][$value])){
                $mapper[$map_key][$value] = $details_tmp[$map_key][$value];
            }
          }
        } //自分より前の人のmapper(group key:item_id value:number)ができる
        }
//        debug($mapper);
        $reserves = [];
        foreach($mapper as $key => $value){
            $reserves[$key] = array_sum($value);
        } //合計値を計算
//        debug($reserves);
        return $reserves; 
     }

}
