<!-- File: /app/View/Posts/index.ctp -->
<div class="row">
    <h1>Blog posts</h1>
<div class="row">

<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered">
            <tr class="active">
                <th>Id</th>
                <th>Title</th>
                <th>Body</th>
                <th>Category</th>
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
                    <?php
                    echo $this->Html->link(
                        $post['Category']['name'],
                        array('controller' => 'Categories', 'action' => 'index', $post['Post']['category_id'])
                    );
                    ?>
                </td>
                <td>
                    <?php echo h($post['Post']['body']);?>
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
            'label' => '題名',
            'placeholder' => 'Type something…',
        ));
        ?>

        <?php
        echo $this->Form->input('body',array(
            'label' => '本文',
            'placeholder' => 'Type something…',
        ));
        ?>

        <?php
        foreach ($categories as $key => $value) {
            $options[$key] = $value['Category']['name'];
        }
        echo $this->Form->select('genre_id', $options);
        ?>

        <?php 
        echo $this->Form->submit('Submit', array(
            'div' => 'form-group',
            'class' => 'btn btn-default'
        )); 
        ?>
        </fieldset>
    </div>
    <div class="col-md-3">
        <table class="table table-bordered">
        <!-- ここで$posts配列をループして、投稿情報を表示 -->
            <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <?php
                    echo $this->Html->link(
                        $category['Category']['name'],
                        array('controller' => 'Categories', 'action' => 'index', $post['Post']['category_id'])
                    );
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
