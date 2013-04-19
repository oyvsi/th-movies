<?php
	
class Group extends AppModel {
	public $primaryKey = 'id';
	public $hasMany = array('Membership' => array('className' => 'Membership', 'foreignKey' => 'membership_id'));
	public $belongsTo = array('Member' => array('className' => 'User', 'foreignKey' => 'id'));
	
	
}
