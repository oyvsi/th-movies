<div class="requests"> 
<?php //print_r($groups);
			$viewArray = array();
		   $i = 0;
	foreach($groups as $group) {
		$viewArray[$group['Group']['id']][$group['Group']['groupName']][$group['User']['id']] = $group['User']['username'];
	  }
		
	foreach($viewArray as $group => $groupName) {
		echo '<div class="group" id=' . $group . '>';
		echo '<h3>' . key($groupName) . '</h3>';
		echo '<table>';
		foreach($groupName as $users) {
			foreach($users as $userId => $userName) {
			echo '<tr><td>' . $this->Html->link($userName, '/users/view/' . $userName) .
						      "<span class=user_" . $userId .  ">" . 
								$this->Html->image('list-add.png') . '</span>' .'</td></tr>';
			}
		}
		echo '</table>';
		echo '</div>';
		
	}
?>
	
</div>