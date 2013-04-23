<div id="edit user">
<?php //print_r($userInfo);
	echo $this->Form->create('User', array('id' => 'EditUser', 'url' => array('controller' => 'users', 'action' => 'edit'), 'type' => 'put'));
	echo $this->Form->input('id', array('id' => 'id', 'type' => 'hidden', 'value' => $userInfo['User']['id']));
	echo $this->Form->input('username', array('id' => 'username', 'type' => 'text', 'value' => $userInfo['User']['username']));
	echo $this->Form->input('firstName', array('id' => 'firstName', 'type' => 'text', 'value' => $userInfo['User']['firstName']));
	echo $this->Form->input('lastName', array('id' => 'lastName', 'type' => 'text', 'value' => $userInfo['User']['lastName']));
	echo $this->Form->input('email', array('id' => 'email', 'type' => 'email', 'value' => $userInfo['User']['email']));
	echo $this->Form->input('password', array('id' => 'password', 'type' => 'password'));
	echo $this->Form->end('Submit');

 ?>
</div>