<?php
class homeController extends controller {
	private $array = [];

	public function __construct(){
		
    }

	public function index() {
		$this->loadTemplate('home', $this->array);
	}
}