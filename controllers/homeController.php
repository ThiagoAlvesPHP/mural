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
}