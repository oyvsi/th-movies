
<?php //echo $this->Html->Link('Top 100 movies', '/movies/top') 
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs',
	array("links" => array(
		0 => array("divId" => "groups1", "header" => "My Groups"), 
		//1 => array("divId" => "", "header" => "hello"), 
		//2 => array("divId" => "", "header" => "hello")
		)));
$this->end();
?>

<div id="groupsInfo"></div>		 
