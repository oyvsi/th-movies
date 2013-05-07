
<div class="profileInformation">
	<h3>User info</h3>
	<p>Ha du nettopp våre å trykkt lite vetta pao "edit" knappen pao sia dar?<br>
		Dao e linken oppi addresselinjao di skadde, og vise "/users/edit". cool?.....
		Denna teksten stamma forøvrig ifrao profile_info.ctp i users viewet.</p>
	<p>User: <?php echo $userInfo['User']['username'];
	if ($userInfo['User']['role'] === "admin") {
		echo " <b>(admin)</b>";
	}?> 
	</p>
	<?php 
		echo "<p>" . $userInfo['User']['firstName'] . " " . $userInfo['User']['lastName'] . "</p>";
		echo "<p>" . $userInfo['User']['email'] . "</p>";
		
		//the code out commented is now obsolete, but remains as a guide for the future.
		/* 
		if(isset($userID) && $userID === $userInfo['User']['id']) {
			echo '<p><a href="' . Router::url('/users/edit') . '">Edit userinfo</a></p>';
		}
		*/
	?>
</div>