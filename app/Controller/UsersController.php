<?php

class UsersController extends AppController {

	public function beforeFilter($user = null) {
		parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
	}

	public function index($user = null) {
		$this->User->recursive = 0;
		//$this->set('user', $this->Auth->user());

	}


//Function called as "GET"-value and shit, its for easyness
	public function profileInfo($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';

			if($user === null) {
				$user = $this->Auth->user('username');
				$this->set('userID', $this->Auth->user('id'));
				
				$this->set('userInfo', $this->User->findByUsername($user));
			}
		}
		//cakephp magic runs profileInfo.ctp (its viewfile).
	}

	public function groupsInfo($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';

			if($user === null) {
				$user = $this->Auth->user('username');
				$this->set('userID', $this->Auth->user('id'));
				$this->set('groups', $this->User->Membership->find('all', array('conditions' => array('User.username' => $user))));

			}
		}
		//cakephp magic runs profileInfo.ctp (its viewfile).
	}

	public function ratedInfo($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';

			if($user === null) {
				$user = $this->Auth->user('username');
				$this->set('userID', $this->Auth->user('id'));
				$this->set('userInfo', $this->User->findByUsername($user));

				$this->set('ratedMovies', $this->User->Rating->find('all', 
				array(	'conditions' => array('User.username' => $user) ,
				'order' => array('Rating.rating DESC'),
				'limit' => 3 
				)));
				$this->set('latestMovies', $this->User->Rating->find('all', 
				array(	'conditions' => array('User.username' => $user) ,
				'order' => array('Rating.modified DESC'),
				'limit' => 3 
				)));
			}
		}
		//cakephp magic runs profileInfo.ctp (its viewfile).
	}


//This function is now obsolete, but remains as laffedr8 does not understand cake
	public function view($user = null) {

		if($user === null) {
			$user = $this->Auth->user('username');
			$this->set('userID', $this->Auth->user('id'));
		}
		$this->set('ratedMovies', $this->User->Rating->find('all', 
		array(	'conditions' => array('User.username' => $user) ,
				'order' => array('Rating.rating DESC'),
				'limit' => 3 
		)));

		$this->set('latestMovies', $this->User->Rating->find('all', 
		array(	'conditions' => array('User.username' => $user) ,
				'order' => array('Rating.modified DESC'),
				'limit' => 3 
		)));


		$this->set('groups', $this->User->Membership->find('all', array('conditions' => array('User.username' => $user))));


		$this->set('userInfo', $this->User->findByUsername($user));

	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
//		print_r($this->request->data);
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->User->save($this->request->data)){
				$this->Session->setFlash(__('Updates saved'));
				$this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('The user could not be updated. Please, try again.'));
			}
		} else {
			$this->set('userInfo', $this->User->findById($this->Auth->user('id')));
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}
