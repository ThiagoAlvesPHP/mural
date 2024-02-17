<?php
class muralController extends controller
{
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $mural;
	private $guidances;
	private $interests;
	private $home;

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
	}

	public function index()
	{
		$this->array['listApproved'] = $this->mural->listApproved();
		$this->array['delete'] = (isset($this->get['delete'])) ? true : false;
		$this->array['approved'] = (isset($this->get['approved'])) ? true : false;
		$this->array['is_infinite'] = (isset($this->get['is_infinite'])) ? true : false;
		$this->array['delete_ids'] = (isset($this->get['delete_ids'])) ? true : false;
		$this->array['delete_all'] = (isset($this->get['delete_all'])) ? true : false;

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
		$this->array['find']['message'] = $this->home->message($this->array['find']);
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

			if (!empty($this->get['redirect'])) {
				header('Location: ' . BASE . 'mural?delete=true');
				exit;
			}

			header('Location: ' . BASE . 'admin?delete=true');
			exit;
		}
		/**update */
		if (!empty($this->get['approved'])) {
			$this->mural->up(["status" => 1, 'id' => $this->get['approved']]);
			header('Location: ' . BASE . 'admin?approved=true');
			exit;
		}

		if (isset($this->get['is_infinite'])) {
			$is_infinite = $this->get['is_infinite'] ? 0 : 1;
			$this->mural->up(["is_infinite" => $is_infinite, 'id' => $this->get['id']]);
			header('Location: ' . BASE . 'mural?is_infinite=true');
			exit;
		}

		// delete in ids
		if (!empty($this->get['delete_ids'])) {
			$ids = $this->get['delete_ids'];

			if (!preg_match('/^(\d+,)+\d+$/', $ids)) {
				header('Location: ' . BASE . 'mural?delete_ids=false');
				exit;
			}

			$idArray = explode(',', $ids);

			if (!array_reduce($idArray, function ($carry, $item) {
				return $carry && ctype_digit($item);
			}, true)) {
				header('Location: ' . BASE . 'mural?delete_ids=false');
				exit;
			}

			$data = $this->mural->listByIds($idArray);

			foreach ($data as $value) {
				if (file_exists($value['photo'])) {
					unlink($value['photo']);
				}

				$this->mural->delete($value['id']);
			}

			header('Location: ' . BASE . 'mural?delete_ids=true');
			exit;
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
			header('Location: ' . BASE . 'mural?delete_all=true');
			exit;
		}
	}
}
