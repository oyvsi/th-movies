	<div id="grouplist">
		<table>
<?php 	

	//"Global" variables for use in the "checkIfRequested"
	$user = $this->Session->read('Auth.User');
	$addMark = $this->Html->image('list-add.png');

	echo "<input type='submit' id='newGroup'  value='New Group'/>";


//"<td class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</td>'; 
	function checkIfRequested($group, $addMark, $user, $class) {

		$requestSent = false;
			foreach($group['MembershipRequest'] as $request) {
				if($request['pending'] == 1 && $request['user_id'] == $user['id']) {
					$requestSent = true;
				}
			}

		if($requestSent && $class) {
			return "none";
		}
		else if($requestSent && !$class) {
			return "Already requested";
		}
		else if(!$requestSent && $class) {
			return "membership";
		}
		else if(!$requestSent && !$class) {
			return $addMark;
		}
	}

	$memberOf = array();
	foreach($memberships as $membership) {
	 	array_push($memberOf, $membership['Group']['groupName']);
	}

	foreach($groups as $group) {
		echo "<tr>";
	/*	$imgMarkup = (in_array($group['Group']['groupName'], $memberOf, true)) ? '<span>' . $this->Html->image('check-mark.png') . '</span>' : "<span class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</span>'; 
*/

		$imgMarkup = (in_array($group['Group']['groupName'], $memberOf, true)) ? '<td>' . $this->Html->image('check-mark.png') . '</td>' : '<td class='.checkIfRequested($group, $addMark, $user, true).' id='.$group['Group']['id'].'>'.checkIfRequested($group, $addMark, $user, false). '</td>';

		//"<td class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</td>'; 



		//echo '<p>' .  $this->Html->link($group['Group']['groupName'], '/groups/listGroup/' . $group['Group']['id']) . $imgMarkup;
		echo '<th id='.$group['Group']['id'].'>'. $group['Group']['groupName'] .'</th>'. $imgMarkup;
		echo "</tr>";	
	} 

?>
		</table>
	</div>