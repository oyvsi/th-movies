<?php
	
class Group extends AppModel {
	//$primaryKey = 'id';
	public $hasMany = array('Membership' => array('className' => 'Membership', 'foreignKey' => 'membership_id'));
		
	
}
