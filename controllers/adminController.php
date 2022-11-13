<?php
class adminController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $mural;

	public function __construct(){
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->mural = new Mural();

		$date = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
		$this->mural->clean($date);
    }

	public function index() {
		$this->array['listPending'] = $this->mural->listPending();
		$this->array['delete'] = (isset($this->get['delete']))?true:false;
		$this->array['approved'] = (isset($this->get['approved']))?true:false;

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