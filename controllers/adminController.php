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
		$this->array['user'] = $this->user->find($_SESSION['cLogin']);

		$this->loadTemplate('admin/home', $this->array);
	}

	/**
	 * update mode
	 */
	public function mode($id = "")
	{
		$this->user->update(["mode" => ($id)?"0":"1"]);
		header('Location: '.BASE.'admin');
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