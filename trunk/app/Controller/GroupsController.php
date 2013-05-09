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
	}

//this page can not be loaded without ajax.
//not sure if it is necessary. gives error if loaded as !ajax request. 
//can be changed in errors view.
	public function listGroups() {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$data = $this->Group->find('all');
			$memberships = $this->Group->Membership->find('all', array('conditions' => array('user_id' => $this->user)));

			$this->set('groups', $data);
			$this->set('memberships', $memberships);
		}
	}

//This function can be loaded without ajax.	
	public function listGroup($id) {

		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		$users = $this->_getMembers($id);
		$this->set('members', $users);
		
		$ratings = array();
		foreach($users as $user) {
			array_push($ratings, $this->Group->Membership->User->Rating->find('all', array('conditions' => array('Rating.user_id' => $user['User']['id']))));
		}
		
		$this->set('data', $ratings);
		
		//$movies = array();
		$movieRatings = array();
		foreach($ratings as $rate) {
			foreach($rate as $rating){
				$movieRatings[$rating['Rating']['movie_id']]['rating'] = 0;
				$movieRatings[$rating['Rating']['movie_id']]['title'] = $rating['Movie']['title'];
				$movieRatings[$rating['Rating']['movie_id']]['movie_id'] = $rating['Rating']['movie_id'];
				if(!isset($movieRatings[$rating['Rating']['movie_id']]['score'])) { 
					$movieRatings[$rating['Rating']['movie_id']]['score'] = $rating['Rating']['rating'];
					$movieRatings[$rating['Rating']['movie_id']]['count'] = 1;
				} else {
					$movieRatings[$rating['Rating']['movie_id']]['score'] += $rating['Rating']['rating'];
					$movieRatings[$rating['Rating']['movie_id']]['count']++;
				}
			}
		}
		
		foreach($movieRatings as &$movieRating) {
			$movieRating['rating'] = number_format($movieRating['score'] / $movieRating['count'], 2);
		}
		
		arsort($movieRatings);
		$this->set('rated', $movieRatings);
	
	}
	
	public function listRequests() {

		if($this->request->is('ajax')) {
			$this->layout = 'ajax';

			$membershipRequests = array('fields' => array('DISTINCT MembershipRequest.group_id',
															   'Group.groupName'),
									 'joins' => array(
												array(
													  'table'=>'membership_requests',
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
													  'table'=>'membership_requests',
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
	}
//this function should have a "failsafe" that occurs when requesting multiple times
//for membership at the same group. could incorporate it with ajax. must have database results first.

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
		if($this->request->is('ajax')) {
		    $this->autoRender = false;
			$this->Group->set(array('owner' => $this->user['id']));
			$this->Group->save($this->request->data);
		}
	}
	
	public function _getMembers($id) {
		return $this->Group->Membership->find('all', array('conditions' => array('Group.id' => $id)));	
	}
	
}
?>
