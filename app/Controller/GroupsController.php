<?php
class GroupsController extends AppController {
	
	public function index() {

	}
	
	public function listGroups() {
		
	}
	
	public function listGroup($id) {
		$data = $this->Group->findById($id);
		$this->set('group', $data);
		$this->set('owner', $this->Group->Member->findById($data['Group']['owner']));
		//$this->set('owner', $this->Group->Owner->find('all'));
	
	}
	
	public function requestMembership() {
		
	}
	
	public function createGroup() {
		
	}
	
}
?>