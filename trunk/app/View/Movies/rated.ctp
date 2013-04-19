<div id="ratedMovies">
	<table>
	<?php	foreach($ratedMovies as $movie): ?>
	<?php 
	$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
	$data = array($link, $movie['Rating']['rating']); ?>
	<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
