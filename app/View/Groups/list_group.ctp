<!--The sideTab is loaded seperately from the index, incase page is loaded "externally". -->
<?php
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs',
	array("links" => array(
		0 => array("divId" => "groups1", "header" => "My Groups"), 
		//1 => array("divId" => "", "header" => "hello"), 
		//2 => array("divId" => "", "header" => "hello")
		)));
$this->end();
?>


<script type="text/javascript">
$(document).ready(function() {
	$("#myTable").tablesorter({ 		//call tablesort plugin
		sortList: [[0,0], [2,0]], 		//sort on first column asc
		headers: {3:{sorter: false}} 	//disable sorting for column 3 and 4		
	});
});
</script>

<div class="etelleranne">
	<h3>Medlemskap:</h3>
	<table>
	<?php //echo "<pre>"; print_r($groups); echo "</pre>";
	foreach($members as $user):?><tr><td><?php
		$link = '<a href="' . Router::url('/users/view/') . $user['User']['username'] . '">' . $user['User']['username'] . '</a>';
		echo $link; 
		if($user['User']['id'] === $user['Group']['owner']) {
			echo ' <b>(owner)</b>';
		} ?> </td></tr><?php
		
	endforeach;	
	?>
	</table>
</div>
<div id="movies_rated">
	<h3>Rated movies with score:</h3>

	<table id="myTable" class="tablesorter">
	<thead>
		<tr><th># <?php echo $this->Html->image('arrows.png');?></th>
		<th>Title<?php echo $this->Html->image('arrows.png');?></th>
		<th># of ratings<?php echo $this->Html->image('arrows.png');?></th>
		<th>Avg. score</th></tr>
	</thead>
	<tbody>
<?php
	$i = 1;
	foreach($rated as $rate){
		$link = '<a href="' . Router::url('/movies/movie/') . $rate['movie_id'] . '">' . $rate['title'] . '</a>';
		$data = array($link); 

		echo "<tr>
				<td>" . $i++ . "</td>
				<td>" . implode('</td><td>', $data) . "</td>
				<td>" . $rate['count'] . "</td>
				<td>" . $rate['rating'] . "</td>
			</tr>";
	}
	
?>
</tbody></table>


</div>