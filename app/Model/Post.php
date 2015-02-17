<?php
class Post extends AppModel {

    public $actsAs = array(
        'Search.Searchable'
    );

    public $filterArgs = array(
        'title' => array(
            'type' => 'like'
        )
    );

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array(
        'Category' => array(
            'className'    => 'Category',
            'foreignKey'   => 'category_id'
        )
    );

}
