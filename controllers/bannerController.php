<?php
class bannerController extends controller
{
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $Banner;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->user->logado();
		$this->Banner = new Banner();
	}

	public function index()
	{
		$this->array['list'] = $this->Banner->list();
		$this->loadTemplate('admin/banner', $this->array);
	}

	/**
	 * actions
	 */
	public function actions()
	{
		/**register */
		if (!empty($this->post['set'])) {
			unset($this->post['set']);

			if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {
				$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				// Verifica se a extensão é PNG ou JPG
				if (in_array(strtolower($extension), array('png', 'jpg', 'jpeg'))) {
					$image = md5(uniqid(rand(), true));
					$image = $image . '.' . $extension;
					$path = 'assets/img/banner/' . $image;

					move_uploaded_file($_FILES['image']['tmp_name'], $path);
					$this->post['image'] = $path;
				} else {
					$_SESSION['alert'] = [
						"class"		=> "warning",
						"message"	=> "Formato de imagem invalida!"
					];

					header('Location: ' . BASE . 'banner');
					exit;
				}
			}

			$this->post['is_active'] = true;
			$this->Banner->set($this->post);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Registrado com sucesso!"
			];

			header('Location: ' . BASE . 'banner');
			exit;
		}
		/** delete */
		if (!empty($this->get['del'])) {
			$find = $this->Banner->find($this->post['id']);
			if (file_exists($find['image'])) {
				unlink($find['image']);
			}

			$this->Banner->delete($this->get['del']);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Deletado com sucesso!"
			];

			header('Location: ' . BASE . 'banner');
			exit;
		}
		/**update */
		if (!empty($this->post['up'])) {
			unset($this->post['up']);
			$find = $this->Banner->find($this->post['id']);

			if (!empty($_FILES['image']) && $_FILES['image']['size'] > 0) {

				if (file_exists($find['image'])) {
					unlink($find['image']);
				}

				$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				// Verifica se a extensão é PNG ou JPG
				if (in_array(strtolower($extension), array('png', 'jpg', 'jpeg'))) {
					$image = md5(uniqid(rand(), true));
					$image = $image . '.' . $extension;
					$path = 'assets/img/banner/' . $image;

					move_uploaded_file($_FILES['image']['tmp_name'], $path);
					$this->post['image'] = $path;
				} else {
					$_SESSION['alert'] = [
						"class"		=> "warning",
						"message"	=> "Formato de imagem invalida!"
					];

					header('Location: ' . BASE . 'banner');
					exit;
				}
			}

			$this->Banner->up($this->post);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Registrado com sucesso!"
			];

			header('Location: ' . BASE . 'banner');
			exit;
		}
	}
}
