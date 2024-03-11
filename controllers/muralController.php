<?php
class muralController extends controller
{
	protected $array = [];
	protected $post;
	protected $get;
	protected $user;
	protected $mural;
	protected $guidances;
	protected $interests;
	protected $home;
	protected $blockEmailIp;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->mural = new Mural();
		$this->guidances = new Guidances();
		$this->interests = new Interest();
		$this->home = new homeController();
		$this->blockEmailIp = new BlockEmailIp();
	}

	public function index()
	{
		$this->array['listApproved'] = $this->mural->listApproved();
		$this->array['listOld'] = $this->mural->listOld();

		if (isset($this->get['photo_valid']) && !empty($this->get['id'])) {
			header('Location: ' . BASE . 'mural/photoValid/' . $this->get['id'] . '?photo_valid=' . $this->get['photo_valid']);
			exit;
		}

		$this->loadTemplate('admin/mural', $this->array);
	}

	/**
	 * valid
	 */
	public function photoValid($id)
	{
		$params = [
			"id" 			=> $id,
			"photo_valid"	=> $this->get['photo_valid']
		];
		$this->mural->up($params);
		header('Location: ' . BASE . 'mural/');
		exit;
	}

	/**
	 * find
	 */
	public function find($id)
	{
		$this->array['guidances'] = $this->guidances->list();
		$this->array['interests'] = $this->interests->list();
		$this->array['success'] = (isset($this->get['success'])) ? true : false;
		$this->array['find'] = $this->mural->find($id);
		$this->loadTemplate('admin/mural_find', $this->array);
	}

	/**
	 * print
	 */
	public function print()
	{
		$this->array['listApproved'] = (!empty($this->get['is_old'])) ? $this->mural->listOld() : $this->mural->listApproved();
		$this->loadView('admin/mural_print', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		/** delete */
		if (!empty($this->get['del'])) {
			$this->mural->delete($this->get['del']);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Publicação deletada com sucesso. ID: " . $this->get['del']
			];
		}
		/**update */
		if (!empty($this->get['approved'])) {
			$this->mural->up(["status" => 1, 'id' => $this->get['approved']]);
			header('Location: ' . BASE . 'admin?approved=true');
			exit;
			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Publicação altorizada com sucesso. " . $this->get['approved']
			];
		}

		// modo infinito
		if (isset($this->get['is_infinite'])) {
			$is_infinite = $this->get['is_infinite'] ? 0 : 1;
			$this->mural->up(["is_infinite" => $is_infinite, 'id' => $this->get['id']]);
			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Modo Infinintum ativado com sucesso para o item marcado. ID: " . $this->get['id']
			];
		}

		// modo is_old
		if (isset($this->get['is_old'])) {
			$find = $this->mural->find($this->get['id']);
			$is_old = $this->get['is_old'] ? 0 : 1;

			$params = [
				"is_old"	=> $is_old,
				"id"		=> $this->get['id']
			];
			if ($find['is_mode_third'] == "1") {
				$params['is_mode_third'] = 0;
			}
			$this->mural->up($params);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Atualizado com sucesso o mural: " . $this->get['id']
			];
		}

		// delete all
		if (!empty($this->get['block'])) {
			$find = $this->mural->find($this->get['block']);
			$serach = $this->blockEmailIp->serach($find['email'], $find['ip']);

			if (count($serach) > 0) {
				$_SESSION['alert'] = [
					"class"		=> "warning",
					"message"	=> "E-mail e IP já estar bloqueado!"
				];
				header('Location: ' . BASE . 'mural');
				exit;
			}

			$params = [
				"email"		=> $find['email'],
				"ip"		=> $find['ip']
			];
			$this->blockEmailIp->set($params);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "E-mail e IP bloqueado com sucesso!"
			];
		}

		// delete in ids
		if (!empty($this->get['delete_ids'])) {
			$ids = $this->get['delete_ids'];

			if (!preg_match('/^(\d+,)+\d+$/', $ids)) {
				$_SESSION['alert'] = [
					"class"		=> "success",
					"message"	=> "Valores indevidos enviados!"
				];
				header('Location: ' . BASE . 'mural');
				exit;
			}

			$idArray = explode(',', $ids);

			if (!array_reduce($idArray, function ($carry, $item) {
				return $carry && ctype_digit($item);
			}, true)) {
				$_SESSION['alert'] = [
					"class"		=> "success",
					"message"	=> "Valores indevidos enviados!"
				];
				header('Location: ' . BASE . 'mural');
				exit;
			}

			$data = $this->mural->listByIds($idArray);

			foreach ($data as $value) {
				if (file_exists($value['photo'])) {
					unlink($value['photo']);
				}

				$this->mural->delete($value['id']);
			}

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Deletado com sucesso!"
			];
		}

		// delete all
		if (!empty($this->get['delete_all'])) {
			$data = $this->mural->list();
			foreach ($data as $value) {
				if (file_exists($value['photo'])) {
					unlink($value['photo']);
				}
			}

			$this->mural->deleteAll();
			$_SESSION['alert'] = [
				"class"		=> "danger",
				"message"	=> "Todos os registros foram deletados com sucesso!"
			];
		}

		header('Location: ' . BASE . 'mural');
		exit;
	}
}
