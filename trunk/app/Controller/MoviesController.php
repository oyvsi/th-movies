<?php

class MoviesController extends AppController {

	public function index($movie = null) {
		$this->set('movie', $this->paginate());
		$this->set('query', $movie);
	}

	public function view($id = null) {
	
	}

	public function rate($movie = null) {
	
	}
}
