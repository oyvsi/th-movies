<?php if ($this->Session->read('Auth.User')) { echo "
<div id=\"menu\">
	<ul>
		<li>
			" . $this->Html->link('Home', '/pages/home') . "
			
		</li>
		<li>
			" . $this->Html->link('Movies', '/movies/rated/') . "
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


