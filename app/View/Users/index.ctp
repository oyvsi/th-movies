<div class="profileInfo">
	<h3>User info</h3>
	<p>User: <?php echo $user['User']['username'];
	if ($user['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	} ?> </p>
	<?php 
		echo "<p>" . $user['User']['firstName'] . " " . $user['User']['lastName'] . "</p>";
		echo "<p>" . $user['User']['email'];
	?>
</div>
<div id="ratedMovies">
	<h3>Top three movies for <?php echo $user['User']['username'];?></h3>
	<table>
		<?php	
		foreach($ratedMovies as $movie): 
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['movie_id'] . '">' . $movie['Movie']['movie_title'] . '</a>';
			$data = array($link, $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
	<h3>Latest ratings for <?php echo $user['User']['username'];?></h3>
	<table>
		<?php	//date("m.d.y, G:i:s"
	foreach($latestMovies as $movie):
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['movie_id'] . '">' . $movie['Movie']['movie_title'] . '</a>';
			$data = array($link, date("m.d.y, G:i:s", strtotime($movie['Rating']['modified'])), $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
