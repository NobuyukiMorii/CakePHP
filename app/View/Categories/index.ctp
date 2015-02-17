<!-- File: /app/View/Categories/index.ctp -->

<h1>Blog categories</h1>
<button class="btn btn-default"><?php echo $this->Html->link('Add Category', array(
    'action' => 'add')); ?></button>

<div class="MarginTopBottom15"></div>

<table class="table table-bordered">
    <tr class="active">
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
    </tr>

<!-- ここで$categories配列をループして、投稿情報を表示 -->
    <?php foreach ($Categories as $Catagory): ?>
    <tr>
        <td><?php echo $Catagory['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($Catagory['Category']['name'], array('action' => 'view', $Catagory['Category']['id']));?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Catagory['Category']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Catagory['Category']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php
echo $this->Form->create('Category', array(
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
