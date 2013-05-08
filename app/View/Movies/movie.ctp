
<?php
	//load sideTabs since this function are called from seperate locations.
	$this->startIfEmpty('sideTabs');
	echo $this->element('sideTabs',
		array("links" => array(
		0 => array("divId" => "movies1", "header" => "Top 100"), 
		1 => array("divId" => "movies2", "header" => "Latest"), 
		2 => array("divId" => "movies3", "header" => "Ratings")
		)));
	$this->end();
?>

<!-- When this page loads, the sidetabs need this div/id to load the new content.-->
<div id="movieInfo">

<div class="rating" id="<?php if(isset($movie))echo $movie['id']; ?>">
<span id="drop_rating"><?php echo $this->Html->image('kuba_icon_delete.png'); ?></span>
<span id="star" <?php if(isset($rating)) echo ' data-score="'. $rating . '"'; ?>></span>
	<span id="rating-hint"></span>
</div>

<div id="movie_info">
	<?php if(isset($movie)) //print_r($movie); ?>
		<span id="title"><?php if(isset($movie)) {
			echo "<h3>" . $movie['title'] . "</h3>"; 	
		?> </span>
		<div id ="rating">
		<?php
			if(isset($avgrating)) {
				echo "Rating at TH-movies: " . $avgrating . ".";
				
			}
		?>
		</div>
		<div id="description"><?php 
		
		if (isset($movie['overview']) && strlen($movie['overview']) > 3){
			echo "<h3>Overview:</h3><p>" . $movie['overview'] . "</p>";
		}
		
		?> </div>
		<?php 
		} ?>
</div>
<div id="tags">
<?php 
echo $this->Form->create('Tag', array('id' => 'AddTag', 'url' => array('controller' => 'movies', 'action' => 'tag')));
echo $this->Form->input('Tag', array('id' => 'tag', 'type' => 'text', 'value' => 'Add tag...'));
echo $this->Form->end();

?>
	<?php 
	if(isset($tags)) {

	foreach($tags as $tag): extract($tag['Tag']) ?>
		<span class="tag" "id"="<?php echo $id ?>"><?php echo  $this->Html->link($tag, array('controller' => 'Tags', 'action' => 'findMovies', $tag)) . " |"?></span>
	<?php endforeach; 
	}
	?>
</div>

<!--end of default content-->
</div>