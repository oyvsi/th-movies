<ul>
	<?php
	//read info about the current user
	$user = $this->Session->read('Auth.User');
	//add current username into the sidetab.
	if($user) {
		echo "<li id='currentuser'>".$user['username']."</li>";
	}

	//Check index for example of how ot push variables into element.
	if(isset($links)) {
		foreach($links as $link) {
			echo "<li id='".$link['divId']."'>".$link['header']."</li>";
		}
	}
	?>
</ul>