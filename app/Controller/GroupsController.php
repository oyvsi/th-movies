<?php
class GroupsController extends AppController {
	
	public function index() {
		$data = $this->Group->find('all');
		$this->set('groups', $data);
	}
	
	public function listGroups() {
		
	}
	
	public function listGroup($id) {
		$this->set('members', $this->_getMembers($id));
	}

	public function requestMembership() {
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