<div id="grouplist">
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	$user = $this->Session->read('Auth.User');
	if($groups) {
	foreach($groups as $group):?><ul><?php
		if($group['Membership']['user_id'] == $user['id']) {
			$link = '<li id='.$group['Group']['id'] . '">' . $group['Group']['groupName'] . '</li>';
			echo $link;?></ul><?php
		}
	endforeach;	

} else {
	echo "You are not involved in any groups.";
}
	?>
</div>