<?php 
	$user = $this->Session->read('Auth.User');
	if ($user) { echo "
		<div id=\"search\">
		<input type=\"text\" id=\"searchBox\" >
		<ul id=\"movies\"></ul>
		</div>"; 
	}
?>


