<?php

$this->startIfEmpty('sideBar');
echo $this->element('sideBar', array("theSearches" => array(1 => "Userinfo", 2 => "Groups", 3 => "Ratings"),
 			"theController" => "users/", 
 			"theAction" =>  array(1 => "profileInfo", 2 => "groupsInfo", 3 => "ratedInfo"), 
 			"theDiv" => "profile"));
$this->end();

?>

<div id="profile">This is the standard Page</div>