<div class="etelleranne">
	<h3>Medlemskap:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($members as $user):?><tr><td><?php
		$link = '<a href="' . Router::url('/users/view/') . $user['User']['id'] . '">' . $user['User']['username'] . '</a>';
		echo $link; 
		if($user['User']['id'] === $user['Group']['owner']) {
			echo ' <b>(owner)</b>';
		} ?> </td></tr><?php
		
	endforeach;	
	?>
	</table>
</div>