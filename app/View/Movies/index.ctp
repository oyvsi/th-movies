<div class="rating" id="<?php if(isset($movie))echo $movie['id']; ?>">
<span id="drop_rating"><?php echo $this->Html->image('kuba_icon_delete.png'); ?></span>
<span id="star" <?php if(isset($rating)) echo ' data-score="'. $rating . '"'; ?>></span>
	<span id="rating-hint"></span>
</div>

<div id="movie_info">
	<?php if(isset($movie)) print_r($movie); ?>
		<span id="title"><?php if(isset($movie)) echo $movie['title']; ?> </span>
		<div id="description"><?php //echo $movie->overview; ?> </div>
</div>
<div id="tags">
<h4>Tags</h4>
<?php 
echo $this->Form->create('Tag', array('url' => array('controller' => 'tags', 'action' => 'add')));
echo $this->Form->input('Tag', array('type' => 'text', 'value' => 'Add tag...'));
echo $this->Form->end();

?>
	<?php foreach($tags as $tag): extract($tag['Tag']) ?>
		<span class="tag" "id"="<?php echo $id ?>"><?php echo  $tag . " |"?></span>
	<?php endforeach; ?>
</div>
