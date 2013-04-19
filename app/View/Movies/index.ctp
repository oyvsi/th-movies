<div class="rating" id="<?php echo $movie['id']; ?>">
<span id="drop_rating"><?php echo $this->Html->image('kuba_icon_delete.png'); ?></span>
<span id="star" <?php if(isset($rating)) echo ' data-score="'. $rating . '"'; ?>></span>
	<span id="rating-hint"></span>
</div>

<div id="movie_info">
	<?php print_r($movie);?>
		<span id="title"><?php echo $movie['title']; ?> </span>
		<div id="description"><?php //echo $movie->overview; ?> </div>
</div>
