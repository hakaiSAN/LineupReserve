    <?= $this->Form->create(false) ?>
    <div id="target">
    <fieldset>
        <legend><?= __('販売商品追加') ?></legend>
    <?php for ($count=0 ; $count < 5; $count++):
/*
        echo $this->Form->input('items.' . $count . '.name', ['label' => '【'.($count+1).'】'. '商品名']);
        echo $this->Form->input('items.' . $count . '.price', ['label' => '【'.($count+1).'】'. '価格', 'type' => 'number']);
        echo $this->Form->input('items.' . $count . '.stock', ['label' => '【'.($count+1).'】'. '在庫数', 'type' => 'number']);
//        echo $this->Form->input('items.' . $count . '.event_id', ['label' => '【'.($count+1).'】'. 'イベント名', 'options' => $events]);
 */
    endfor; ?>
    </div>
    </fieldset>
<!--
    <?= $this->Form->button(__('登録')) ?>
-->
    <?= $this->Form->end() ?>
<button onclick="addform()">add form</button>



<!--
<div id="target">
</div>
<button onclick="addform()">add form</button>
-->
<script>
addform = function(){
  var frm_cnt = 0;
  frm_cnt++;
  
  var div_element =document.createElement("div");
  div_element.innerHTML = ' <label for=items- ' + frm_cnt + ' -name> </label>;
  //  <input type="text" name=items['+frm_cnt+'][name] id=items-' +frm_cnt+ '-name;
  var parent_object = document.getElementById("target");
  parent_object.appendChild(div_element);

}
</script>

