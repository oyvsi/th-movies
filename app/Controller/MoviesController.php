<?php 
class MoviesController extends AppController {
	private $user;
	private $apikey = 'a8049ffed9e54f709cc42647f7a42722';
	private $rtBase = 'http://api.themoviedb.org/3/movie/';
	private $searchURL = "http://api.themoviedb.org/3/search/movie";
	var $components = array('RequestHandler');

	public function index() {
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->user = $this->Auth->user();

		// Regular request
		if(isset($this->request->params['id']))
			$this->movie_id = $this->request->params['id'];
		// For ajax
		elseif(isset($this->data['id']))
			$this->movie_id = $this->data['id'];

		if(isset($this->movie_id) && $this->user) {
			$this->Movie->Rating->data = $this->Movie->Rating->find('first', array('conditions' => array('Rating.user_id' => $this->user['id'], 'Rating.movie_id' => $this->movie_id)));
			if(!($this->Movie->Rating->data)) {
				$this->Movie->Rating->create();
				$this->Movie->Rating->set(array('user_id' => $this->user['id'], 'movie_id' => $this->movie_id));
			} else
				$this->Movie->Rating->id = $this->Movie->Rating->data['Rating']['movie_rating_id'];
		} 

	}
	/**
	* Function shows info about a movie. Also gives
	* users the possibility to rate and tag. 
	* The page shows current rating and avg rating.
	*
	*/
	public function movie() {
	
		if($this->user && isset($this->Movie->Rating->data['Rating']['rating'])) {
			$this->set('rating', $this->Movie->Rating->data['Rating']['rating']);
		}
 
		$this->Movie->Behaviors->attach('Containable');
		$query = $this->Movie->find('first', array('contain' => array('MoviesTags.Tag'), 'conditions' => array('Movie.id' => $this->movie_id)));
		$this->Movie->Behaviors->detach('Containable');

		//print_r($query);

		if($query) {
			$this->Movie->data = $query['Movie'];
		}	else { 
			$movie = json_decode($this->get_json($this->rtBase . $this->movie_id . '?api_key=' . $this->apikey), true);
			//$this->Movie->create();
			$this->Movie->save($movie);
			$this->Movie->data = $movie;	
		}
		
		$ratings = $this->Movie->Rating->find('all', array('conditions' => array('Rating.movie_id' => $this->Movie->data['id'])));
		$i = 0; $total = 0; $avg = 0;
		foreach($ratings as $rating){
			$total += $rating['Rating']['rating'];
			$i++;
			$avg = $total / $i;
		}
		
		$this->set('avgrating', number_format($avg, 2));
		if(isset($query['MoviesTags'])) {
			$this->set('tags', $query['MoviesTags']); 
		} else {
			$this->set('tags', null);
		}
		$this->set('movie', $this->Movie->data);
		$this->render('movie');
	}

	/**
	* Fuction adds an users rating to a movie.
	*
	*/
	public function rate() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			if($this->Movie->Rating->id)
				$this->Movie->Rating->saveField('rating', $this->data['rating']);
			else
				$this->Movie->Rating->save($this->data);
		}	
	}

	/**
	* Fuction shows all tags on a movie,
	* and offers tag possebilities to the movie
	*
	*/
	public function tag() {
		if($this->request->is('ajax')) 
			$this->autoRender = false;
		
		$tag = $this->data['tag'];

		$dbTag = $this->Movie->MoviesTags->Tag->findByTag($tag);
		$tagMovie = false;
		// Tag exists
		if($dbTag) {
			$tagMovie = $this->Movie->MoviesTags->findByTagIdAndMovieId($dbTag['Tag']['id'], $this->movie_id);
		} else { // Add the tag
			$data = array('tag' => $tag, 'user_id' => $this->user['id']);
			$dbTag = $this->Movie->MoviesTags->Tag->Save($data);
			print_r($dbTag);
		}
		// Add the tag to the movie
		if(!$tagMovie)
			$this->Movie->MoviesTags->save(array('movie_id' => $this->movie_id, 'tag_id' => $dbTag['Tag']['id']));
	}

	/**
	* Function deletes a rating.
	*
	*/
	public function drop() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->Movie->Rating->delete();
		}
	}

	/**
	* Fuction makes a list of the top movies.
	*
	*/	
	public function top() {
		
		$ratings = $this->Movie->Rating->find('all', array(
				'order' => array('Rating.movie_id ASC')));

		//print_r($ratings);

		$movieRatings = array();
		foreach($ratings as $rating) {
			$movieRatings[$rating['Rating']['movie_id']]['rating'] = 0;
			$movieRatings[$rating['Rating']['movie_id']]['title'] = $rating['Movie']['title'];
			$movieRatings[$rating['Rating']['movie_id']]['movie_id'] = $rating['Rating']['movie_id'];
			if(!isset($movieRatings[$rating['Rating']['movie_id']]['score'])) { 
				$movieRatings[$rating['Rating']['movie_id']]['score'] = $rating['Rating']['rating'];
				$movieRatings[$rating['Rating']['movie_id']]['count'] = 1;
			} else {
				$movieRatings[$rating['Rating']['movie_id']]['score'] += $rating['Rating']['rating'];
				$movieRatings[$rating['Rating']['movie_id']]['count']++;
			}
		}
		
		foreach($movieRatings as &$movieRating) {
			$movieRating['rating'] = number_format($movieRating['score'] / $movieRating['count'], 2);
		}
		
		arsort($movieRatings);
		$this->set('rated', $movieRatings);
	}

	/**
	* Fuction makes a list of latest rated movies.
	*
	*/	
	public function latestMovies() {
		$this->set('latestMovies', $this->Movie->Rating->find('all', 
		array(	'order' => array('Rating.modified DESC')
		)));
	}

	/**
	* Fuction shows a users rating based on logged in user
	* or $user
	*
	* @param int $user
	*/
	public function rated($user = null) {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if($user === null) {
				$user = $this->user['username'];
			}
			$data = $this->Movie->Rating->find('all', array('conditions' => array('User.username' => $user)));
			($data) ? $this->set('ratedMovies', $data) : $this->set('noContent', true);
		}
	}	

	/**
	* Fuction searches for movies.
	*
	*/
	public function searchMovies() {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if(isset($_GET['search'])) {
				$searchResult = $this->get_json($this->searchURL .'?api_key=' . $this->apikey . '&query=' . urlencode($_GET['search']));
				print($searchResult);
			}
		}
	}

	private function get_json($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
}
