<?php
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#myTable").tablesorter({ 		//call tablesort plugin
		sortList: [[0,0], [2,0]], 		//sort on first column asc
		headers: {3:{sorter: false}} 	//disable sorting for column 3 and 4		
	});
});
</script>

<div>
<h3>Top 100 movies</h3>

<table id="myTable" class="tablesorter"><thead><tr><th># <?php echo $this->Html->image('arrows.png');?></th><th>Title<?php echo $this->Html->image('arrows.png');?></th><th># of ratings<?php echo $this->Html->image('arrows.png');?></th><th>Avg. score</th></tr></thead><tbody><?php
	$i = 1;
	foreach($rated as $rate){
		if ($i <= 100) {
			//echo "<tr><td>" . implode('</td><td>', $rate) . "</td></tr>";
			echo "<tr><td>" . $i . "</td><td>" . $rate['title'] . "</td><td>" . $rate['count'] . "</td><td>" . $rate['rating'] . "</td></tr>";
		}
		$i++;
	}
	
?>
</tbody></table>	
</div>