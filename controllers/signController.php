<?php
class signController extends controller
{
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $Sign;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->Sign = new Sign();
	}

	public function index()
	{
		$this->array['list'] = $this->Sign->list();
		$this->array['success'] = (isset($this->get['success'])) ? true : false;
		$this->array['up'] = (isset($this->get['up'])) ? true : false;
		$this->array['delete'] = (isset($this->get['delete'])) ? true : false;
		
		$this->loadTemplate('admin/sign', $this->array);
	}
	/**
	 * actions
	 */
	public function actions()
	{
		/**register */
		if (!empty($this->post['set'])) {
			unset($this->post['set']);
			$this->Sign->set($this->post);
			header('Location: ' . BASE . 'sign?success=true');
			exit;
		}
		/** delete */
		if (!empty($this->get['del'])) {
			$this->Sign->delete($this->get['del']);
			header('Location: ' . BASE . 'sign?delete=true');
			exit;
		}
		/**update */
		if (!empty($this->post['up'])) {
			unset($this->post['up']);

			$this->Sign->up($this->post);
			header('Location: ' . BASE . 'sign?success=true&up=true');
			exit;
		}
	}
}
