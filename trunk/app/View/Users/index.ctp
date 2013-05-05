<?php

$this->startIfEmpty('sideTabs');
echo $this->element('sideTabs',
	array("links" => array(
		0 => array("divId" => "user1", "header" => "Profile info"), 
		1 => array("divId" => "user2", "header" => "Groups"), 
		2 => array("divId" => "user3", "header" => "Ratings"))));
$this->end();

?>

<div id="profile">This is the standard Page</div>