	<div id="grouplist">
		<table>
<?php 	

	//"Global" variables for use in the "checkIfRequested"
	$user = $this->Session->read('Auth.User');
	$addMark = $this->Html->image('list-add.png');

	echo "<input type='submit' id='newGroup'  value='New Group'/>";


//magic function
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
//magic stuff
	$groupIds = array();
	$userIds = array();
	foreach($memberships as $membership) {
	 	array_push($groupIds, $membership['Membership']['group_id']);
	 	array_push($userIds, $membership['Membership']['user_id']);
	}

	$i = 0;
	foreach($groups as $group) {
		++$i;
		echo "<tr>";
		if($group['Group']['owner'] == $user['id'] || $group['Membership']['user_id'] == $userIds[$i]) {
			$imgMarkup = '<td>' . $this->Html->image('check-mark.png') . '</td>';

		} else {
			$imgMarkup = '<td class='.checkIfRequested($group, $addMark, $user, true).' id='.$group['Group']['id'].'>'.checkIfRequested($group, $addMark, $user, false). '</td>';
		}

		echo '<th id='.$group['Group']['id'].'>'. $group['Group']['groupName'] .'</th>'. $imgMarkup;
		echo "</tr>";	
		$i++;
	} 

?>
		</table>
	</div>