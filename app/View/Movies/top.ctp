<div>
<h3>Top 100 movies</h3>
<pre><?php 
?><table><th>Title</th><th># of ratings</th><th>Avg. score</th><?php
	//print_r($rated);
	$i = 0;
	foreach($rated as $rate){
		if ($i < 100) {
			echo "<tr><td>" . $rate['title'] . "</td><td>" . $rate['count'] . "</td><td>" . $rate['score'] . "</td></tr>";
		}
		$i++;
	}
	
?>
</table>

</pre>	
</div>