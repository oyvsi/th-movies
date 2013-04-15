<?php

class MoviesController extends AppController {
	private $apikey = 'a8049ffed9e54f709cc42647f7a42722';
	private $rtBase = 'http://api.themoviedb.org/3/movie/';

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
		$id = $this->request->params['id'];
		$movie = $this->get_json($this->rtBase . $id . '?api_key=' . $this->apikey);
		$this->set('movie', json_decode($movie));
		$this->render('index');

	}

	public function rate($movie = null) {
	
	}
}
