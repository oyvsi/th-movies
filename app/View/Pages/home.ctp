<h1>Welcome to ThMovies</h1>
<p>This is a very cool website where you can rate you're favorite (or least favorite) movies</p>
<?php if($user) echo $user['username']; 
		else echo $this->Html->link('Register', array('controller' => 'Users', 'action' => 'add'));
 		echo $this->Html->link('Log out', array('controller' => 'Users', 'action' => 'logout'));

