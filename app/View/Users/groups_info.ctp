

	<h3>Groups:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($groups as $group):?><tr><td><?php
		$link = '<a href="' . Router::url('/groups/listGroup/') . $group['Group']['id'] . '">' . $group['Group']['groupName'] . '</a>';
		echo $link;?></td></tr><?php
	endforeach;	
	?>
	</table>
