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
	/**
	* Fuction shows logged in or $user's info.
	* 
	* @param int $user
	*/
	public function profileInfo($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
		if($user === null) {
			$user = $this->Auth->user('username');
			$this->set('userID', $this->Auth->user('id'));
				
			$this->set('userInfo', $this->User->findByUsername($user));
		}
		
		//cakephp magic runs profileInfo.ctp (its viewfile).
	}

	/**
	* Fuction shows logged in or $user's groupmemberships
	* 
	* @param int $user
	*/
	public function groupsInfo($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';

			if($user === null) {
				$user = $this->Auth->user('username');
				$this->set('userID', $this->Auth->user('id'));
				$this->set('groups', $this->User->Membership->find('all', array('conditions' => array('User.username' => $user))));

			}
		}
	}

	/**
	* Fuction shows userinfo, top three rated movies and three latest movies
	* for a logged in user or $user.
	* 
	* @param int $user
	*/
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

	/**
	* Fuction adds a user into the database
	* 
	*/	
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('controller' => 'users/login'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	/**
	* Fuction edits a users info
	* 
	* @param int $user
	* @param int $id
	*/
	public function edit($id = null, $user = null) {
		if($user === null) {
			$user = $this->Auth->user('username');
			$this->set('userID', $this->Auth->user('id'));
		}

		$this->set('userInfo', $this->User->findByUsername($user));
		if(isset($id) && $id === $this->Auth->user('id')) {
			if($this->request->is('post') || $this->request->is('put')) {
				if($this->User->save($this->request->data)){
					$this->Session->setFlash(__('Updates saved'));
					$this->redirect(array('action' => 'profileInfo'));
				} else {
					$this->Session->setFlash(__('The user could not be updated. Please, try again.'));
				}
			} else {
				$this->set('userInfo', $this->User->findById($this->Auth->user('id')));
			}
		}
	}

	/**
	* Fuction deletes a user based on the $id
	* 
	* @param int $id
	*/
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

	/**
	* Fuction to log in a user
	*/
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

	/**
	* Fuction to log out a user
	*/
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}
