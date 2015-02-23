<?php
class Group extends AppModel {

    public $hasMany = array(
        'User' => array(
            'className'     => 'User',
            'foreignKey'    => 'group_id'
        )
    );
    
    public $actsAs = array('Acl' => array('type' => 'requester'));

}
