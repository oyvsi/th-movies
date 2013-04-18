<?php
class GroupsController extends AppController {
	
	public function index() {

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