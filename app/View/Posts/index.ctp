<!-- File: /app/View/Posts/index.ctp -->

<h1>Blog posts</h1>
<button class="btn btn-default"><?php echo $this->Html->link('Add Post', array(
    'action' => 'add')); ?></button>

<div class="MarginTopBottom15"></div>

<table class="table table-bordered">
    <tr class="active">
        <th>Id</th>
        <th>Title</th>
        <th>Body</th>
        <th>Category</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- ここで$posts配列をループして、投稿情報を表示 -->
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <td>
            <?php echo h($post['Category']['name']);?>
        </td>
        <td>
            <?php echo h($post['Post']['body']);?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php
echo $this->Form->create('Post', array(
    'action' => 'find',
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well'
));
?>
<fieldset>
<legend>Legend</legend>

<?php
echo $this->Form->input('title',array(
    'label' => 'Label name',
    'placeholder' => 'Type something…',
));
?>


<?php 
echo $this->Form->submit('Submit', array(
    'div' => 'form-group',
    'class' => 'btn btn-default'
)); 
?>
</fieldset>