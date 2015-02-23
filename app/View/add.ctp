<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Group</h1>
<?php
echo $this->Form->create('Group');
echo $this->Form->input('name');
echo $this->Form->end('Save Group');
?>