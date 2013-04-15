<p>Info about one movie</p>
<div id="star"></div>
<span id="rating-hint"></span>
<input type="text" id="searchBox">
<ul  style="list-style-type: none" id="movies"></ul>


	<?php if($movie): ?>
		<span id="title"><?php echo $movie->title; ?> </span>
		<div id="description"><?php echo $movie->synopsis; ?> </div>
	<?php endif; ?>

