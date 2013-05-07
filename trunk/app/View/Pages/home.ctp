<div id="frontpage">

<h1>Welcome to ThMovies</h1>
<p>This is a very cool website where you can rate you're favorite (or least favorite) movies</p>

</div>

<?php 
	//loads sidetab
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs',
		array("links" => array(
			0 => array("divId" => "asd", "header" => "Nye muligheter"), 
			//1 => array("divId" => "user2", "header" => "Groups")
			)));
	$this->end();


	if(!$user) {
		echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'add'));
		//echo $user['username'];
	}

