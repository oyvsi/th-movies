<div>
<h3>Top 100 movies</h3>
<pre><?php 
?><table><?php
	//print_r($rated);
	$i = 0;
	foreach($rated as $rate){
		if ($i < 100) {
			echo "<tr><td>" . $rate['title'] . "</td><td>" . $rate['score'] . "</td></tr>";
		}
		$i++;
	}
	
?>
</table>

</pre>	
</div>