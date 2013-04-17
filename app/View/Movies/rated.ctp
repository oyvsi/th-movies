<div id="ratedMovies">
	<table>
	<?php	foreach($ratedMovies as $movie): ?>
	<?php 
	$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['movie_id'] . '">' . $movie['Movie']['movie_title'] . '</a>';
	$data = array($link, $movie['Rating']['rating']); ?>
	<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
