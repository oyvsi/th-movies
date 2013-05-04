<?php

class AboutsController extends AppController {

	private $aboutPK = "quite possibly the manliest man on earth.";

	private $aboutBundy = "you will never outlive this guy.";

	private $aboutFlesh = "Casanova wouldnt stand a chance.";

	private $aboutLaff = "Was born yesterday. Abortion failed.";


	public function index() {
		
		
	}
	public function about() {
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			if(isset($_GET['search'])) {

				$choice = $_GET['search'];

				switch($choice) {
					case "PK":
						print($this->aboutPK);
						break;
					case "bundy":
						print($this->aboutBundy);
						break;
					case "flash":
						print($this->aboutFlesh);
						break;
					case "laff":
						print($this->aboutLaff);
						break;
				}
			}
		}
	}

}
