<ul>
	<?php
	//Check index - about for example of 
		foreach($links as $link) {
			echo "<li id='".$link['divId']."'>".$link['header']."</li>";
		}
	?>
</ul>