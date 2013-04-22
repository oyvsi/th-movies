<div id="edit user"><pre>
<?php //print_r($userInfo);
	echo $this->Form->create('Edit', array('id' => 'EditUser', 'url' => array('controller' => 'users', 'action' => 'edit')));
	echo $this->Form->input('Username', array('id' => 'username', 'type' => 'text', 'value' => $userInfo['User']['username']));
	echo $this->Form->input('Firstname', array('id' => 'firstName', 'type' => 'text', 'value' => $userInfo['User']['firstName']));
	echo $this->Form->input('Lastname', array('id' => 'lastName', 'type' => 'text', 'value' => $userInfo['User']['lastName']));
	echo $this->Form->input('E-mail', array('id' => 'email', 'type' => 'email', 'value' => $userInfo['User']['email']));
	echo $this->Form->input('New password', array('id' => 'password', 'type' => 'password'));
	echo $this->Form->end();

 ?>
</pre></div>