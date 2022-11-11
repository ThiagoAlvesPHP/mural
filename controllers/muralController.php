<?php
class muralController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $mural;
	private $guidances;
	private $interests;
	private $home;

	public function __construct(){
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->mural = new Mural();
		$this->guidances = new Guidances();
		$this->interests = new Interest();
		$this->home = new homeController();
    }

	public function index() {
		$this->array['listApproved'] = $this->mural->listApproved();
		$this->array['delete'] = (isset($this->get['delete']))?true:false;
		$this->array['approved'] = (isset($this->get['approved']))?true:false;

		$this->loadTemplate('admin/mural', $this->array);
	}

	/**
	 * find
	 */
	public function find($id)
	{
		$this->array['guidances'] = $this->guidances->list();
		$this->array['interests'] = $this->interests->list();
		$this->array['success'] = (isset($this->get['success']))?true:false;
		$this->array['find'] = $this->mural->find($id);
		$this->array['find']['message'] = $this->home->message($this->array['find']);

		$this->loadTemplate('admin/mural_find', $this->array);
	}

	/**
	 * print
	 */
	public function print()
	{
		$this->array['listApproved'] = $this->mural->listApproved();

		$this->loadView('admin/mural_print', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		/** delete */
		if(!empty($this->get['del'])) {
			$this->mural->delete($this->get['del']);

			if (!empty($this->get['redirect'])) {
				header('Location: '.BASE.'mural?delete=true');
				exit;
			}

			header('Location: '.BASE.'admin?delete=true');
		}
		/**update */
		if (!empty($this->get['approved'])) {
			$this->mural->up(["status" => 1, 'id' => $this->get['approved']]);
			header('Location: '.BASE.'admin?approved=true');
		}
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