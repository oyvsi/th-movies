
<div id="menu">
	<ul>
		<li>
			<?php
			echo $this->Html->link('Home', '/pages/home'); 
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Movies', '/movies/rated/'); 
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Profil', '/users'); 
			?>
		</li>
		<li>
			<?php if ($this->Session->read('Auth.User')) { echo $this->Html->link('Groups', '/groups'); }  
			?>
		</li>
				</ul>
</div>
<div id="search">
<input type="text" id="searchBox" >
<ul id="movies"></ul>
</div>


