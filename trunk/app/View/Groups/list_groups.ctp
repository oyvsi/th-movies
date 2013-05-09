	<div id="grouplist">
		<table>
<?php 	

	//"Global" variables for use in the "checkIfRequested"
	$user = $this->Session->read('Auth.User');
	$addMark = $this->Html->image('list-add.png');

	echo "<input type='submit' id='newGroup'  value='New Group'/>";


//"<td class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</td>'; 
	function checkIfRequested($group, $addMark, $user) {
		//$addMark = "<td class='membership'>".$this->Html->image('list-add.png')."</td>";
		$requestSent = "Already requested";


		foreach($group['MembershipRequest'] as $request) {
			if($request['pending'] == 1 && $request['user_id'] == $user['id']) {
				return $requestSent;
			}
		}
		return $addMark;
	}
/*
	foreach($groups as $group) {
		foreach($group['MembershipRequest'] as $request) {
			if($request['pending']) {
				echo "<pre>";
				print_r($request['pending']);
				echo "</pre>";
			}
		}
	}
*/

	$memberOf = array();
	foreach($memberships as $membership) {
	 	array_push($memberOf, $membership['Group']['groupName']);
	}
/*
	$i = 0;
	foreach($membershipRequests as $membershipRequest) {
		if($user['id'] == $membershiRequest[$i]['id'] && !$membershipRequest[$i]['pending']) {

			echo "<pre>";
			print_r($membershipRequest[$i]['group_id']);
			echo "</pre>";
		}
	}
*/
	foreach($groups as $group) {
		echo "<tr>";
	/*	$imgMarkup = (in_array($group['Group']['groupName'], $memberOf, true)) ? '<span>' . $this->Html->image('check-mark.png') . '</span>' : "<span class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</span>'; 
*/

		$imgMarkup = (in_array($group['Group']['groupName'], $memberOf, true)) ? '<td>' . $this->Html->image('check-mark.png') . '</td>' : '<td class="membership" id='.$group['Group']['id'].'>'.checkIfRequested($group, $addMark, $user). '</td>';

		//"<td class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</td>'; 



		//echo '<p>' .  $this->Html->link($group['Group']['groupName'], '/groups/listGroup/' . $group['Group']['id']) . $imgMarkup;
		echo '<th id='.$group['Group']['id'].'>'. $group['Group']['groupName'] .'</th>'. $imgMarkup;
		echo "</tr>";	
	} 

?>
		</table>
	</div>