<?php foreach($groups as $group)
	  	echo '<p>' .  $this->Html->link($group['Group']['groupName'], '/groups/listGroup/' . $group['Group']['id']) . 
			 "<span class=\"membership\" id=" . $group['Group']['id'] .  ">" . $this->Html->image('list-add.png') . '</span>' ;?>
					 