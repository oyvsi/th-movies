<div class="profileInfo">
	<h3>User info</h3>
	<p>User: <?php echo $userInfo['User']['username'];
	if ($userInfo['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	}?> 
	</p>
	<?php 
		echo "<p>" . $userInfo['User']['firstName'] . " " . $userInfo['User']['lastName'] . "</p>";
		echo "<p>" . $userInfo['User']['email'];
	?>
</div>
