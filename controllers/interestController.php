<?php
class interestController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $interest;

	public function __construct(){
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->interest = new Interest();
    }

	public function index() {
		$this->array['list'] = $this->interest->list();
		$this->array['error'] = (isset($this->get['error']))?true:false;
		$this->array['success'] = (isset($this->get['success']))?true:false;
		$this->array['delete'] = (isset($this->get['delete']))?true:false;
		$this->array['up'] = (isset($this->get['up']))?true:false;

		$this->loadTemplate('admin/interest', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		/**register */
		if (!empty($this->post['set'])) {
			unset($this->post['set']);

			if ($this->interest->validate($this->post['title'])) {
				$this->interest->set($this->post);
				header('Location: '.BASE.'interest?success=true');
			} else {
				header('Location: '.BASE.'interest?error=true');
			}
		}
		/** delete */
		if(!empty($this->get['del'])) {
			$this->interest->delete($this->get['del']);
			header('Location: '.BASE.'interest?delete=true');
		}
		/**update */
		if (!empty($this->post['up'])) {
			unset($this->post['up']);

			$this->interest->up($this->post);
			header('Location: '.BASE.'interest?success=true&up=true');
		}
	}
}