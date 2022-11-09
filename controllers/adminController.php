<?php
class adminController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;

	public function __construct(){
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
    }

	public function index() {

		$this->loadTemplate('admin/home', $this->array);
	}

	/**
	 * logout
	 */
	public function logout()
	{
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: '.BASE);
	}
}