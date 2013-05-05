
<?php

$this->startIfEmpty('sideBar');
echo $this->element('sideBar', 	
	array("links" => array(
		0 => array("divId" => "about1", "header" => "PK"), 
		1 => array("divId" => "about2", "header" => "bundy"), 
		2 => array("divId" => "about3", "header" => "flash"), 
		3 => array("divId" => "about4", "header" => "laff"))));

$this->end();

?>


<div id="information">We are Teamhenkars, and this is our story...</div>