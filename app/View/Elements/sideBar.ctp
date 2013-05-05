<ul>
	<?php
	//Check index - about for example of 
		foreach($links as $link) {
			echo "<li><div id='".$link['divId']."'>".$link['header']."</div></li>";
		}
	?>
</ul>