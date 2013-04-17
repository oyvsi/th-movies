<div class="rating" id="<?php echo $movie['movie_id']; ?>">
<span id="star" <?php if(isset($rating)) echo ' data-score="'. $rating . '"'; ?>></span>
	<span id="rating-hint"></span>
</div>

<div id="movie_info">
	<?php print_r($movie);?>
		<span id="title"><?php echo $movie['movie_title']; ?> </span>
		<div id="description"><?php //echo $movie->overview; ?> </div>
</div>
