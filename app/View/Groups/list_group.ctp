<div class="etelleranne">
	<h3>Medlemskap:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($members as $user):?><tr><td><?php
		$link = '<a href="' . Router::url('/users/view/') . $user['User']['username'] . '">' . $user['User']['username'] . '</a>';
		echo $link; 
		if($user['User']['id'] === $user['Group']['owner']) {
			echo ' <b>(owner)</b>';
		} ?> </td></tr><?php
		
	endforeach;	
	?>
	</table>
</div>
<div id="movies_rated">
	<h3>Rated movies with score:</h3>

	<table><thead><tr><th>#</th><th>Title</th><th># of ratings</th><th>Avg. score</th></tr></thead><tbody><?php
	$i = 1;
	foreach($rated as $rate){
		echo "<tr><td>" . $i++ . "</td><td>" . $rate['title'] . "</td><td>" . $rate['count'] . "</td><td>" . $rate['rating'] . "</td></tr>";
	}
	
?>
</tbody></table>


</div>