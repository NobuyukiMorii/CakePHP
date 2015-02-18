<!-- File: /app/View/Categories/index.ctp -->
<div class="row">
    <h1>カテゴリー<?php echo h($Categories[0]['Category']['name']);?>の一覧</h1>
</div>

<div class="row">
    <div class="col-sm-9">

        <table class="table table-bordered">
            <tr class="active">
                <th>Id</th>
                <th>Title</th>
                <th>Created</th>
            </tr>

            <?php foreach ($Categories[0]['Post'] as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td>
                    <?php echo $this->Html->link($post['title'], array('controller' => 'Posts' , 'action' => 'view' , $post['id']));?>
                </td>
                <td>
                    <?php echo h($post['created']);?>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <div class="col-sm-3">
            <table class="table table-bordered">
            <?php foreach ($CategoriesList as $Category): ?>
            <tr>
                <td>
                    <?php if($category_id == $Category['Category']['id']): ?>
                    <?php echo $Category['Category']['name'] ;?>
                    <?php else: ?>
                    <?php echo $this->Html->link($Category['Category']['name'], array('controller' => 'Categories' , 'action' => 'index' , $Category['Category']['id']));?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>

    </div>
</div>
