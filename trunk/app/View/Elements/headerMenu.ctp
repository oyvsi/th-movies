<?php $user = $this->Session->read('Auth.User');
		if ($user) { echo "
<div id=\"menu\">
	<ul>
		<li>
			" . $this->Html->link('Home', '/pages/home') . "
			
		</li>
		<li>
			" . $this->Html->link('Movies', '/movies/rated') . "
		</li>
		<li>
			
			" . $this->Html->link('Profil', '/users') . "
			
		</li>
		<li>
			" . $this->Html->link('Groups', '/groups') . " 
			
		</li>
		<li>
			" . $this->Html->link('Log out', '/users/logout') . " 
			
		</li> 
		    "; if($user['role'] === 'admin') echo "<li>
			" . $this->Html->link('Requests', '/groups/listRequests') . " 
			</li>";
		echo "
</ul>
</div>
<div id=\"search\">
<input type=\"text\" id=\"searchBox\" >
<ul id=\"movies\"></ul>
</div>";
} else { echo " <div id=\"menu\">
		 <li>
			" . $this->Html->link('Login', '/users/login') . "
		</li> </div>"; }?>


