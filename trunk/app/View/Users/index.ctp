<?php

$this->startIfEmpty('sideTabs');
echo $this->element('sideTabs',
	array("links" => array(
		0 => array("divId" => "user2", "header" => "Info"),
		1 => array("divId" => "user1", "header" => "Edit")
		)));
$this->end();

?>

<div id="profileInfo"></div>