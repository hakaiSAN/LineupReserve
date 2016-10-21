<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class CountingComponent extends Component {
    //行列の全員を数える
     public function processionCount($event_id) {
        $processions = TableRegistry::get('Processions');
        $total = $processions->find('all',['conditions' => ['event_id' => $event_id]])->count();
        return $total;
     }
     //全商品の予約数を数える
     public function reserveCount(){
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
        return $reserves; 
     }
}
