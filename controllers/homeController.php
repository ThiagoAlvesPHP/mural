<?php
class homeController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $guidances;
	private $interest;

	public function __construct(){
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->guidance = new Guidances();
		$this->interest = new Interest();
    }

	public function index() {
		$this->array['guidances'] = $this->guidance->list();
		$this->array['interests'] = $this->interest->list();
		$this->array['colors'] = $this->colors();

		$this->loadTemplate('home', $this->array);
	}

	/**
	 * login user
	 */
	public function login()
	{
		$this->array['error'] = (isset($this->get['error']))?true:false;

		if ($this->array['error']) {
			$this->array['data'] = base64_decode($this->get['data']);
			$this->array['data'] = json_decode($this->array['data']);
		}
		$this->loadTemplate('login', $this->array);
	}

	/**
	 * action login
	 */
	public function actionLogin()
	{
		if (!empty($this->post)) {
			if ($this->user->login($this->post)) {
				header('Location: '.BASE.'admin');
			} else {
				header('Location: '.BASE.'home/login?error=true&data='.base64_encode(json_encode($this->post)));
			}
		}
	}

	/**
	 * color public
	 */
	public function colors()
	{
		$this->array['colors'] = [
			[
				'color' => '#3dbaf1'
			],
			[
				'color' => '#0a71c0'
			],
			[
				'color' => '#ffc001'
			],
			[
				'color' => '#ffff0e'
			],
			[
				'color' => '#9ed981'
			],
			[
				'color' => '#2fc57d'
			],
			[
				'color' => '#cf200e'
			],
			[
				'color' => '#ff194e'
			],
			[
				'color' => '#924aa5'
			],
			[
				'color' => '#b3aad8'
			],
			[
				'color' => '#fc29de'
			],
			[
				'color' => '#da9594'
			],
			[
				'color' => '#443d3d'
			]
		];

		return $this->array['colors'];
	}
}