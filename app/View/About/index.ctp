<?php

$this->startIfEmpty('sideBar');
echo $this->element('sideBar', array("thedivs" => array(1 => "PK", 2 => "bundy", 3 => "flash", 4 =>"laff"),
 					"thepage" => "app/View/About/about.ctp"));
$this->end();

?>

<div id="about"></div>
