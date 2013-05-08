<div id="frontpage">

<h1>Welcome to ThMovies</h1>
<p>This is a very cool website where you can rate you're favorite (or least favorite) movies</p>

</div>

<?php 
	//loads sidetab
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs',
		array("links" => array(
			0 => array("divId" => "movies4", "header" => "My top 3's"),
			1 => array("divId" => "movies3", "header" => "My movies"), 
			2 => array("divId" => "movies1", "header" => "Top 100"), 
			3 => array("divId" => "movies2", "header" => "Latest ratings") 
			)));
	$this->end();


	if(!$user) {
		echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'add'));
		//echo $user['username'];
	}

