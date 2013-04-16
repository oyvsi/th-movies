<div class="profileInfo">
	<p>User: <?php echo $user['User']['username'];
	if ($user['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	} ?> </p>
	<?php 
		echo "<p>" . $user['User']['firstName'] . " " . $user['User']['lastName'] . "</p>";
		echo "<p>" . $user['User']['email'];

	?>
</div>