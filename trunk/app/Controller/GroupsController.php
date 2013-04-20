<?php
class GroupsController extends AppController {
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->user = $this->Auth->user();
		if(isset($this->data['group_id'])) $this->group_id = $this->data['group_id'];
		$this->Group->MembershipRequest->create();
		$this->Group->MembershipRequest->set(array('user_id' => $this->user['id'], 'group_id' => $this->group_id));
	}
	
	public function index() {
		$data = $this->Group->find('all');
		$this->set('groups', $data);
	}
	
	public function listGroups() {
		
	}
	
	public function listGroup($id) {
		$this->set('members', $this->_getMembers($id));
	}
	
	public function listRequests() {
		$membershipRequests = array('fields' => array('DISTINCT MembershipRequest.group_id',
															   'Group.groupName'),
									 'joins' => array(
												array(
													  'table'=>'membershiprequests',
													   'alias'=>'MembershipRequest',
													   'type'=>'LEFT',
													   'conditions' => array(
													   'MembershipRequest.group_id = Group.id'
          )
      )
   ), 'conditions' => array('Group.owner' => $this->user['id']));
		
		$temp = array('fields' => array('DISTINCT MembershipRequest.group_id',
												  'MembershipRequest.id',
												  'Group.groupName',
												   'User.username',
												  'User.id'),
									  'recursive' => 0,
									 'joins' => array(
												array(
													  'table'=>'membershiprequests',
													   'alias'=>'MembershipRequest',
													   'type'=>'LEFT',
													   'conditions' => array(
													   'MembershipRequest.group_id = Group.id'
          )
      ),	array(
													  'table'=>'users',
													   'alias'=>'User',
													   'type'=>'LEFT',
													   'conditions' => array(
													   'MembershipRequest.user_id = User.id'
          )
      )
   ), 'conditions' => array('Group.owner' => $this->user['id']));

	
		$groups = $this->Group->find('all', $temp);
		$this->set('groups', $groups);
		
	}

	public function requestMembership() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->Group->MembershipRequest->save($this->request->data);
			
		}
		
	}
	
	public function addUser() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
		}
	}
	
	
	public function createGroup() {
		
	}
	
	public function _getMembers($id) {
		return $this->Group->Membership->find('all', array('conditions' => array('Group.id' => $id)));	
	}
	
}
?>