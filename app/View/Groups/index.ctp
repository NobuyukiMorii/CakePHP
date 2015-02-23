<table class="table">
    <tr class="active">
        <th>Id</th>
        <th>Name</th>
        <th>Modified</th>
        <th>Created</th>
    </tr>

<!-- ここで$groups配列をループして、投稿情報を表示 -->
    <?php foreach ($groups as $group): ?>
    <tr>
        <td><?php echo $group['Group']['id']; ?></td>
        <td>
            <?php
            echo $this->Html->link(
                $group['Group']['name'],
                array('controller' => 'Groups', 'action' => 'index', $group['Group']['id'])
            );
            ?>
        </td>
        <td>
            <?php echo h($group['Group']['modified']);?>
        </td>
        <td>
            <?php echo $group['Group']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>