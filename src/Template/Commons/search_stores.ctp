<h3><?= __('店舗検索') ?></h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
            echo $this->Form->input('search', ['label'=> '店舗名']);
        ?>
        <?= $this->Form->button(__('検索')) ?>
        <?= $this->Form->end() ?>
    </fieldset>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('店舗名') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stores as $store): ?>
            <tr>
                <td><?= h($store->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('開く'), ['action' => 'viewStore', $store->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
