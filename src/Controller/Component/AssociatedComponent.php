<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class AssociatedComponent extends Component {

     //Itemのidをkeyとしてnameとpriceをバリューにとるような連想配列を返す
     public function ItemsNamePriceStock(){
        $tmps =  TableRegistry::get('Items')->find('all', [
        'fields' => ['id','name' ,'price', 'stock'],
        ])->toArray();
        foreach($tmps as $tmp){
            $items[$tmp->id] = [
              'name' =>$tmp->name,
              'price'=>$tmp->price,
              'stock'=>$tmp->stock
            ];
        }
        return $items; 
     }

     //オーダーの状態を調べる
     public function stateOrders(){
        $orders= TableRegistry::get('Orders');
        $mapper = $orders->find('list',[
          'keyField' => 'id',
          'valueField' => 'paid'
        ]);
        $mapper = $mapper->toArray();
//        debug($mapper);
        $state_orders = null;
        foreach($mapper as $key => $value){
          if($value == null){
            $state_orders[$key] = "未払い";
          }
          else {
//            $state_orders[$key] = "支払済";
            $state_orders[$key] = $value;
          }
        } 
        //状態を格納
        return $state_orders; 
     }
}
