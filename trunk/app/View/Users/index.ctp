<div class="profileInfo">
	<p>User: <?php echo $user['username'];
	if ($user['role'] === "admin") {
		echo " <b>(admin)</b>";
	} ?> </p>
	<?php 
		echo "<p>" . $user['firstName'] . " " . $user['lastName'] . "</p>";

	?>
</div>
