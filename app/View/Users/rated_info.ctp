
<div id="ratedInfo">
	<h3>Top three movies for <?php echo $userInfo['User']['username'];?></h3>
	<table>
		<?php	
		foreach($ratedMovies as $movie): 
			$link = '<a href="' . Router::url('/movies/movie/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
	<h3>Latest ratings for <?php echo $userInfo['User']['username'];?></h3>
	<table>
		<?php	//TimeHelper::
	foreach($latestMovies as $movie):
			$link = '<a href="' . Router::url('/movies/movie/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $this->Time->readableTime($movie['Rating']['modified']), $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
