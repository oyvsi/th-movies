<?php

class MoviesController extends AppController {
	private $apikey = 'bvswh94ct9uug45678ncjk9v';
	private $rtBase = 'http://api.rottentomatoes.com/api/public/v1.0/movies/';

	public function index($movie = null) {
		$this->set('movie', $this->paginate());
		$this->set('query', $movie);
	}

	public function view() {
		$id = $this->request->params['id'];
		$movie = file_get_contents($this->rtBase . '/' . $id . '.json?apikey=' . $this->apikey);
		$this->set('movie', json_decode($movie));
		
		$this->render('index');

	}

	public function rate($movie = null) {
	
	}
}
