    <?= $this->Form->create($details) ?>
    <fieldset>
        <legend><?= __('注文編集') ?></legend>
        <?php 
            foreach ($details as $key => $detail): 
              echo $this->Form->hidden($key .'.id', ['value'=>$detail['id']]);
              echo $this->Form->input($key .'.item_id', ['label' => '商品名', 'options' => $items, 'value'=>$detail['item_id'], 'disabled'=>'disabled']);
              echo $this->Form->input($key.'.number', ['label'=>'注文数', 'value'=>$detail['number']]);
            endforeach;
              for($key = $key+1; $key < $count; $key++) : //追加分
                echo $this->Form->input($key .'.item_id', ['label' => '商品名', 'options' => $items, 'empty' => '商品を選んでください']);
                echo $this->Form->input($key.'.number', ['label'=>'注文数', 'type' => 'number']);
            endfor;
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
