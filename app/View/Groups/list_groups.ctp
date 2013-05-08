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
		echo '<li id='.$group['Group']['id'].'>'. $group['Group']['groupName'] .'</li>'. $imgMarkup;
	} 

?>
	</div>