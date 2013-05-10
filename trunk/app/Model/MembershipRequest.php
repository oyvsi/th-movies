<?php
class MembershipRequest extends AppModel {
var $useTable = 'membershiprequests';

	public $primaryKey = 'id';    
	public $belongsTo = array('Group' => array('className' => 'Group', 'foreignKey' => 'group_id'),
							  'User' => array('className' => 'User', 'foreignKey' => 'user_id'));

    
}