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


	public function view() {
		if($this->user && isset($this->Movie->Rating->data['Rating']['rating'])) {
			$this->set('rating', $this->Movie->Rating->data['Rating']['rating']);
		}

		$query = $this->Movie->find('first', array('conditions' => array('Movie.id' => $this->movie_id)));

		if($query) {
			$this->Movie->data = $query['Movie'];
		}	else { 
			$movie = json_decode($this->get_json($this->rtBase . $this->movie_id . '?api_key=' . $this->apikey), true);
			//$this->Movie->create();
			$this->Movie->save($movie);
			$this->Movie->data = $movie;	
		}	

		$this->set('movie', $this->Movie->data);
		$this->render('index');
	}

	public function rate() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			if($this->Movie->Rating->id)
				$this->Movie->Rating->saveField('rating', $this->data['rating']);
			else
				$this->Movie->Rating->save($this->data);
		}	
	}

	public function drop() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->Movie->Rating->delete();
		}
	}

	public function rated($user = null) {
		if($user === null)
			$user = $this->user['username'];
		$data = $this->Movie->Rating->find('all', array('conditions' => array('User.username' => $user)));
		($data) ? $this->set('ratedMovies', $data) : $this->set('noContent', true);
		
			 
		
	}	

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
