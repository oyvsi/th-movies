<h1>Welcome to ThMovies</h1>
<p>This is a very cool website where you can rate you're favorite (or least favorite) movies</p>
<?php 
	//loads sidetab
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs');
	$this->end();


	if(!$user) {
		echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'add'));
		//echo $user['username'];
	}

