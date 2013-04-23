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
		$memberships = $this->Group->Membership->find('all', array('conditions' => array('user_id' => $this->user)));
		$this->set('groups', $data);
		$this->set('memberships', $memberships);
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
   ), 'conditions' => array('Group.owner' => $this->user['id'], 'MembershipRequest.pending' => 1));

	
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
		    $userId = $this->request->data['user_id'];
		    $groupId = $this->request->data['group_id'];
		    $id = $this->Group->MembershipRequest->findByUserIdAndGroupId($userId, $groupId);
		    print_r($id);
		    $this->Group->MembershipRequest->id = $id['MembershipRequest']['id'];
		    $this->Group->MembershipRequest->saveField('pending', 0);
                    $this->Group->Membership->save($this->request->data);
	
		}
	}
	
	
	public function createGroup() {
		
	}
	
	public function _getMembers($id) {
		return $this->Group->Membership->find('all', array('conditions' => array('Group.id' => $id)));	
	}
	
}
?>
