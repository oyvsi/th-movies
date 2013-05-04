
<?php

$this->startIfEmpty('sideBar');
echo $this->element('sideBar', array("theSearches" => array(1 => "PK", 2 => "bundy", 3 => "flash", 4 =>"laff"),
 			"theController" => "abouts/", 
 			"theAction" => "about", 
 			"theDiv" => "information"));
$this->end();

?>


<div id="information">We are Teamhenkars, and this is our story...</div>