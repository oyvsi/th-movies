<?php
	
class Group extends AppModel {
	public $primaryKey = 'id';
	public $hasMany = array('Membership' => array('className' => 'Membership', 'foreignKey' => 'membership_id'),
							'MembershipRequest' => array('className' => 'Membershiprequest', 'foreignKey' => 'group_id'));
	//public $belongsTo = array('Member' => array('className' => 'User', 'foreignKey' => 'id'));
	
	
}
