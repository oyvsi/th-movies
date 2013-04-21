<?php
class TagsController extends AppController {
	// Move to model
	public function find($movie_id, $search) {
		// brute force, baby!
		$query = 'SELECT tag from tags WHERE id NOT IN (SELECT tag_id FROM movies_tags WHERE movie_id = ?) AND tag LIKE ?';
		$tags = $this->Tag->getDataSource()->fetchAll($query, array($movie_id, $search . '%'));
		
		echo "<pre>";
		print_r($tags);
	}
}
?>
