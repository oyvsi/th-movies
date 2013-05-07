<?php

$this->startIfEmpty('sideTabs');
echo $this->element('sideTabs',
	array("links" => array(
		0 => array("divId" => "user1", "header" => "Profile info"), 
		1 => array("divId" => "user2", "header" => "Groups"))));
$this->end();

?>

<div id="profilepage">This is the standard Page</div>