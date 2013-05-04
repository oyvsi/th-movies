<ul>
	<?php
/*
$theController: name of the controller ending with an / (without controller).

$theAction: name of the function within the controller above that are to be called..
OBS! $theAction must also be the name of the div to be changed (this can be changed later if need).

$theSearches: array of searches (function arguments for function above).

Example of how to setup this is shown in "index.ctp - Abouts".
*/

	if(count($theSearches) == count($theAction)) {
		$i = 1;
		foreach($theSearches as $theSearch) {
			echo "<li><a href='".$theController."#".$theAction[$i]."#".$theSearch."#".$theDiv."'>".$theSearch."</a></li>";
			$i++;
		}

	} else {
		foreach($theSearches as $theSearch) {
			echo "<li><a href='".$theController."#".$theAction."#".$theSearch."#".$theDiv."'>".$theSearch."</a></li>";
		}
	}


	?>
</ul>