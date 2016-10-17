<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['action' => 'indexStores']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'indexEvents']) ?> </li>
    </ul>
</nav>
<div class="stores view large-9 medium-8 columns content">
    <h3><?= h($store->name) ?></h3>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($store->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($store->events as $events): ?>
            <tr>
                <td><?= h($events->date) ?></td>
                <td><?= h($events->location) ?></td>
                <td><?= h($events->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'viewEvent', $events->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
