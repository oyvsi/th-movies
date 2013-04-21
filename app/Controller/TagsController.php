<?php
class TagsController extends AppController {
	// Move to model
	public function find($movie_id, $search = null) { 
		if(isset($this->request->query['term']))
			$search = $this->request->query['term'];
		// brute force, baby!
		$query = 'SELECT tag from tags WHERE id NOT IN (SELECT tag_id FROM movies_tags WHERE movie_id = ?) AND tag LIKE ?';
		$tags = $this->Tag->getDataSource()->fetchAll($query, array($movie_id, $search . '%'));
		
		$this->autoRender = false;
		$results = array();
		foreach($tags as $tag)
			array_push($results, $tag['tags']['tag']);
		echo json_encode($results);
	}

	public function findMovies($tag) {
//        $query = $this->Movie->find('first', array('contain' => array('MoviesTags.Tag'), 'conditions' => array('Movie.id' => $this->movie_id)));

  		$this->Tag->Behaviors->attach('Containable');
		$movies = $this->Tag->find('all', array('contain' => array('MoviesTags.Movie.title'), 'conditions' => array('Tag.tag' => $tag)));
		$this->set('tag', $tag);
		if($movies) 
			$this->set('movies', $movies[0]['MoviesTags']);
	}
}
?>
