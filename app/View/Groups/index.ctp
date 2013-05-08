
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

<div id="groupsInfo">
	<div id="grouplist">
<?php 	

	echo "<input type='submit' id='newGroup'  value='New Group'/>";


	$memberOf = array();
	foreach($memberships as $membership) {
	 	array_push($memberOf, $membership['Group']['groupName']);
	}
	foreach($groups as $group) {
		$imgMarkup = (in_array($group['Group']['groupName'], $memberOf, true)) ? '<span>' . $this->Html->image('check-mark.png') . '</span>' : "<span class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</span>'; 

		//echo '<p>' .  $this->Html->link($group['Group']['groupName'], '/groups/listGroup/' . $group['Group']['id']) . $imgMarkup;
		echo '<li id='.$group['Group']['id'].'>'. $group['Group']['groupName'] . $imgMarkup;
	} 

?>
	</div>
</div>		 
