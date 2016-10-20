<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar/commons'); ?>
</nav>
<div class="events index large-9 medium-8 columns content">
    <h3><?= __('イベント検索') ?></h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
            echo $this->Form->input('search.name', ['label'=> '名前']);
            echo $this->Form->input('search.date', ['label'=> '日付', 'type' =>'date', 'empty' => '--']);
            echo $this->Form->input('search.location', ['label'=> '開催場所']);
            echo $this->Form->input('search.store_id', ['label'=> '店舗名', 'options' => $stores, 'empty' => '---']);
        ?>
        <?= $this->Form->button(__('検索')) ?>
        <?= $this->Form->end() ?>
    </fieldset>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('イベント名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('開催場所') ?></th>
                <th scope="col"><?= $this->Paginator->sort('店舗名') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->date) ?></td>
                <td><?= h($event->location) ?></td>
                <td><?= h($event->store->name) ?></td>
                <td><?= $this->Html->link(__('開く'), ['action' => 'viewEvent', $event->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
