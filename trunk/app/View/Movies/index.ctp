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
	<?php foreach($tags as $tag): extract($tag['Tag']) ?>
		<span class="tag" "id"="<?php echo $id ?>"><?php echo  $this->Html->link($tag, array('controller' => 'Tags', 'action' => 'findMovies', $tag)) . " |"?></span>
	<?php endforeach; ?>
</div>
