<?php
class adminController extends controller
{
	protected $array = [];
	protected $post;
	protected $get;
	protected $user;
	protected $mural;
	protected $blockEmailIp;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->mural = new Mural();
		$this->blockEmailIp = new BlockEmailIp();

		$date = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
		$dateCa = date('Y-m-d', strtotime('-32 days', strtotime(date('Y-m-d'))));
		$dateDel = date('Y-m-d', strtotime('-365 days', strtotime(date('Y-m-d'))));
		$this->mural->clean($date, $dateCa, $dateDel);
	}

	public function index()
	{
		$this->array['listPending'] = $this->mural->listPending();
		$this->array['delete'] = (isset($this->get['delete'])) ? true : false;
		$this->array['approved'] = (isset($this->get['approved'])) ? true : false;
		$this->array['user'] = $this->user->find($_SESSION['cLogin']);
		$this->array['blocks'] = $this->blockEmailIp->list();

		$this->loadTemplate('admin/home', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		// delete block
		if ($this->get['delBlock']) {
			$this->blockEmailIp->delete($this->get['delBlock']);

			$_SESSION['alert'] = [
				"class"		=> "danger",
				"message"	=> "Deletado com sucesso!"
			];

			header('Location: ' . BASE . 'admin');
			exit;
		}
	}

	/**
	 * update mode
	 */
	public function mode($id = "")
	{
		$this->user->update(["mode" => ($id) ? "0" : "1"]);
		header('Location: ' . BASE . 'admin');
		exit;
	}

	/**
	 * logout
	 */
	public function logout()
	{
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: ' . BASE);
		exit;
	}
}
