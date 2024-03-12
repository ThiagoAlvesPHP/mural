<?php
class interestController extends controller
{
	protected $array = [];
	protected $post;
	protected $get;
	protected $user;
	protected $interest;
	protected $InterestPrimary;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->interest = new Interest();
		$this->InterestPrimary = new InterestPrimary();
	}

	public function index()
	{
		$this->array['interest'] = $this->interest->list();
		$this->array['interest_primary'] = $this->InterestPrimary->list();

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
				$_SESSION['alert'] = [
					"class"		=> "success",
					"message"	=> "Registrado com sucesso!"
				];
			} else {
				$_SESSION['alert'] = [
					"class"		=> "warning",
					"message"	=> "Título já registrado."
				];
			}
		}
		/** delete */
		if (!empty($this->get['del'])) {
			$this->interest->delete($this->get['del']);
			$_SESSION['alert'] = [
				"class"		=> "danger",
				"message"	=> "Deletado com sucesso!"
			];
		}
		/**update */
		if (!empty($this->post['up'])) {
			unset($this->post['up']);

			$this->interest->up($this->post);
			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Atualizado com sucesso!"
			];
		}

		// register InterestPrimary
		if (!empty($this->post['set_' . InterestPrimary::TABLE])) {
			unset($this->post['set_' . InterestPrimary::TABLE]);
			$this->post['is_active'] = 1;

			$this->InterestPrimary->set($this->post);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Registrado com sucesso!"
			];
		}

		// update InterestPrimary
		if (!empty($this->post['up_' . InterestPrimary::TABLE])) {
			unset($this->post['up_' . InterestPrimary::TABLE]);

			$this->InterestPrimary->up($this->post);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Atualizado com sucesso!"
			];
		}

		header('Location: ' . BASE . 'interest');
		exit;
	}
}
