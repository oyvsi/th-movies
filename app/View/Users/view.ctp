
<div class="profileInfo">
	<h3>User info</h3>
	<p>User: <?php echo $userInfo['User']['username'];
	if ($userInfo['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	}?> 
	</p>
	<?php 
		echo "<p>" . $userInfo['User']['firstName'] . " " . $userInfo['User']['lastName'] . "</p>";
		echo "<p>" . $userInfo['User']['email'] . "</p>";
		if(isset($userID) && $userID === $userInfo['User']['id']) {
			echo '<p><a href="' . Router::url('/users/edit') . '">Edit userinfo</a></p>';
		}
	?>
</div>

<div class="groups">
	<h3>Gruppemedlemskap:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($groups as $group):?><tr><td><?php
		$link = '<a href="' . Router::url('/groups/listGroup/') . $group['Group']['id'] . '">' . $group['Group']['groupName'] . '</a>';
		echo $link;?></td></tr><?php
	endforeach;	
	?>
	</table>
</div>

<div id="ratedMovies">
	<h3>Top three movies for <?php echo $userInfo['User']['username'];?></h3>
	<table>
		<?php	
		foreach($ratedMovies as $movie): 
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
	<h3>Latest ratings for <?php echo $userInfo['User']['username'];?></h3>
	<table>
		<?php	//TimeHelper::
	foreach($latestMovies as $movie):
			$link = '<a href="' . Router::url('/movies/') . $movie['Movie']['id'] . '">' . $movie['Movie']['title'] . '</a>';
			$data = array($link, $this->Time->readableTime($movie['Rating']['modified']), $movie['Rating']['rating']); ?>
			<tr><?php echo '<td>' . implode('</td><td>', $data) . '</td>';  ?></tr>
	<?php endforeach; ?>
	</table>
</div>
