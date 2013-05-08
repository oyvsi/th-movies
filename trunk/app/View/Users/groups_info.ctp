<div id="grouplist">
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($groups as $group):?><ul><?php
		$link = '<li id='.$group['Group']['id'] . '">' . $group['Group']['groupName'] . '</li>';
		echo $link;?></ul><?php
	endforeach;	
	?>
</div>