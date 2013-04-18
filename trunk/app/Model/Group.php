<?php
	
class Group extends AppModel {
	//$primaryKey = 'id';
	public $hasMany = array('Membership' => array('className' => 'Membership', 'foreignKey' => 'membership_id'));
	public $belongsTo = array('Owner' => array('className' => 'User', 'foreignKey' => 'user_id'));
	
	
}
