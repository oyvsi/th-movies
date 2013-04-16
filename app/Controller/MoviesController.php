<?php

class MoviesController extends AppController {
	private $apikey = 'a8049ffed9e54f709cc42647f7a42722';
	private $rtBase = 'http://api.themoviedb.org/3/movie/';
	var $components = array('RequestHandler');


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

	public function index($movie = null) {
		$this->set('movie', $this->paginate());
		$this->set('query', $movie);
	}

	public function view() {
		$user = $this->Auth->user();
		$id = $this->request->params['id'];
		if($user) {
			$this->loadModel('Rating');
			$rating = $this->Rating->find('first', array('conditions' => array('user_id' => $user['id'], 'movie_id' => $id), 'fields' => array('rating')));
			if($rating)
				$this->set('rating', $rating['Rating']['rating']);
		}

		$movie = $this->get_json($this->rtBase . $id . '?api_key=' . $this->apikey);
		$this->set('movie', json_decode($movie));
		$this->render('index');
	}

	public function rate() {
		$this->loadModel('Rating');
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$user = $this->Auth->user();
			$data = array('user_id' => $user['id'], 'movie_id' => $this->data['movie'], 'rating' => $this->data['rating'], 'timestamp' => time());
			$this->Rating->save($data);
		}	
	}
}
