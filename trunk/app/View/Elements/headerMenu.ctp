
<div id="menu">
	<ul>
		<li>
			<?php
			echo $this->Html->link('Home', '/pages/home'); 
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Movies', '/movies'); 
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Profil', '/users'); 
			?>
		</li>
				</ul>
</div>
<div id="search">
<input type="text" id="searchBox" >
<ul id="movies"></ul>
</div>


