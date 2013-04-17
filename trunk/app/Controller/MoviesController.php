<?php

class MoviesController extends AppController {
	private $user;
	private $apikey = 'a8049ffed9e54f709cc42647f7a42722';
	private $rtBase = 'http://api.themoviedb.org/3/movie/';
	private $searchURL = "http://api.themoviedb.org/3/search/movie";
	var $components = array('RequestHandler');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->loadModel('Rating');
		$this->user = $this->Auth->user();

		if(isset($this->request->params['id']))
			$this->movie_id = $this->request->params['id'];
		elseif(isset($this->data['movie_id']))
			$this->movie_id = $this->data['movie_id'];
		else
			//$this->setAction('movieList');

		if(isset($this->movie_id) && $this->user) {
			$this->Rating->data = $this->Rating->find('first', array('conditions' => array('user_id' => $this->user['id'], 'movie_id' => $this->movie_id)));
			if(!($this->Rating->data)) {
				$this->Rating->create();
				$this->Rating->set(array('user_id' => $this->user['id'], 'movie_id' => $this->movie_id));
			} else
				$this->Rating->id = $this->Rating->data['Rating']['movie_rating_id'];
		}
	}
	
	
	public function movieList() {
		echo "Cool list of movies or something";
	}

	public function view() {
		if($this->user && isset($this->Rating->data['Rating']['rating'])) {
			$this->set('rating', $this->Rating->data['Rating']['rating']);
		}

		$movie = $this->get_json($this->rtBase . $this->movie_id . '?api_key=' . $this->apikey);
		$this->set('movie', json_decode($movie));
		$this->render('index');
	}

	public function rate() {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if($this->Rating->id)
				$this->Rating->saveField('rating', $this->data['rating']);
			else
				$this->Rating->save($this->data);
		}	
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
