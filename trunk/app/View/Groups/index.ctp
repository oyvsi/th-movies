<?php foreach($groups as $group)
	  	echo '<p>' .  $this->Html->link($group['Group']['groupName'], '/groups/listGroup/' . $group['Group']['id']) . '</p>' ;?>