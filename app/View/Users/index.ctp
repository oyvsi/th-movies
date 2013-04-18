<div class="profileInfo">
	<h3>User info</h3>
	<p>User: <?php echo $user['User']['username'];
	if ($user['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	}?> 
	</p>
	<?php 
		echo "<p>" . $user['User']['firstName'] . " " . $user['User']['lastName'] . "</p>";
		echo "<p>" . $user['User']['email'];
	?>
</div>

<div class="groups">
	<h3>Gruppemedlemskap:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($groups as $group):?><tr><td><?php
		$link = '<a href="' . Router::url('/groups/') . $group['Group']['id'] . '">' . $group['Group']['groupName'] . '</a>';
		echo $link;?></td></tr><?php
	endforeach;	
	?>
	</table>
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
		<?php	//TimeHelper::
	foreach($latestMovies as $movie):
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['movie_id'] . '">' . $movie['Movie']['movie_title'] . '</a>';
			$data = array($link, $this->Time->readableTime($movie['Rating']['modified']), $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
