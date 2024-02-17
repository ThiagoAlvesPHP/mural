<?php
class guidanceController extends controller
{
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $Guidances;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->Guidances = new Guidances();
	}

	public function index()
	{
		$this->array['list'] = $this->Guidances->list();
		$this->array['error'] = (isset($this->get['error'])) ? true : false;
		$this->array['success'] = (isset($this->get['success'])) ? true : false;
		$this->array['delete'] = (isset($this->get['delete'])) ? true : false;
		$this->array['up'] = (isset($this->get['up'])) ? true : false;

		$this->loadTemplate('admin/guidance', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		/**register */
		if (!empty($this->post['set'])) {
			unset($this->post['set']);

			if ($this->Guidances->validate($this->post['title'])) {
				$this->Guidances->set($this->post);
				header('Location: ' . BASE . 'guidance?success=true');
			} else {
				header('Location: ' . BASE . 'guidance?error=true');
			}
			exit;
		}
		/** delete */
		if (!empty($this->get['del'])) {
			$this->Guidances->delete($this->get['del']);
			header('Location: ' . BASE . 'guidance?delete=true');
			exit;
		}
		/**update */
		if (!empty($this->post['up'])) {
			unset($this->post['up']);

			$this->Guidances->up($this->post);
			header('Location: ' . BASE . 'guidance?success=true&up=true');
			exit;
		}
	}
}
