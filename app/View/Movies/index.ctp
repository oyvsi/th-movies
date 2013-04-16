<p>Info about one movie</p>
<div id="star"></div>
<span id="rating-hint"></span>

	<?php if($movie): ?>
		<span id="title"><?php echo $movie->title; ?> </span>
		<div id="description"><?php echo $movie->overview; ?> </div>
	<?php endif; ?>

