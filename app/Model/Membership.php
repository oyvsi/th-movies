<?php
class Membership extends AppModel {
	public $primaryKey = 'membership_id';    
	public $belongsTo = array('Group' => array('className' => 'Group', 'foreignKey' => 'group_id'),
							  'User' => array('className' => 'User', 'foreignKey' => 'user_id'));

    
}