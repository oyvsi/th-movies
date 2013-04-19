<?php
class GroupsController extends AppController {
	
	public function index() {
		$data = $this->Group->find('all');
		$this->set('groups', $data);
	}
	
	public function listGroups() {
		
	}
	
	public function listGroup($id) {
		$this->set('members', $this->Group->Membership->find('all', array('conditions' => array('Group.id' => $id))));
	}

	public function requestMembership() {
		
	}
	
	public function createGroup() {
		
	}
	
}
?>