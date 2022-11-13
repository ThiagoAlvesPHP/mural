<?php
class homeController extends controller {
	private $array = [];
	private $post;
	private $get;
	private $user;
	private $guidances;
	private $interests;
	private $mural;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->guidances = new Guidances();
		$this->interests = new Interest();
		$this->mural = new Mural();

		$date = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
		$this->mural->clean($date);
    }

	public function index() {
		$this->array['guidances'] = $this->guidances->list();
		$this->array['interests'] = $this->interests->list();
		$this->array['colors'] = $this->colors();
		$this->array['success'] = (isset($this->get['success']))?true:false;

		$this->loadTemplate('home', $this->array);
	}

	/**
	 * register public
	 */
	public function register()
	{
		if (!empty($this->post)) {
			$mode = $this->user->findMode();

			$this->post = array_filter($this->post);
			$this->post['message'] = $this->message($this->post);

			if ($mode['mode']) {
				if (!empty($this->post['complement'])) {
					$this->post['status'] = '0';
				}
			}

			foreach ($this->colors() as $key => $value) {
				if ($key == $this->post['color']) {
					$this->post['color'] = $value['color'];
				}
			}
			$this->mural->set($this->post);

			if ($mode['mode']) {
				if (!empty($this->post['complement'])) {
					header('Location: '.BASE.'?success=true&status=true');
					exit;
				}
			}
			
			header('Location: '.BASE.'?success=true');
		}
	}

	/**
	 * mural
	 */
	public function mural()
	{
		$this->array['listApproved'] = $this->mural->listApproved();
		
		$this->loadTemplate('mural', $this->array);
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

	/**
	 * 
	 */
	public function ajax()
	{
		$this->array['status'] = false;
		$this->array['data'] = [];

		if ($this->post) {
			$this->array['status'] = true;
			$this->array['data'] = $this->post;
			$this->array['data']['message'] = $this->message($this->post);
			foreach ($this->colors() as $key => $value) {
				if ($key == $this->post['color']) {
					$this->array['data']['colorHex'] = $value['color'];
				}
			}
		}

		echo json_encode($this->array);
	}

	/**
	 * message
	 */
	public function message($data)
	{
		$message = '';

		foreach ($this->colors() as $key => $value) {
			if ($key == $data['color']) {
				if ($data['color'] == 0) {
					$message = "OI, ME CHAMO {$data['name']}, MINHA ORIENTAÇÃO SEXUAL É {$data['guidance']}, TENHO {$data['age']} ANOS. MEU E-MAIL É: {$data['email']} / E MEU WHATSAPP É: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}.";
				}
				if ($data['color'] == 1) {
					$message = "OLÁ, MEU NOME É {$data['name']}, TENHO POR ORIENTAÇÃO SEXUAL A CLASSIFICAÇÃO {$data['guidance']}, MINHA IDADE É {$data['age']} ANOS. E AQUI VÃO OS MEUS CONTATOS PARA NOS LIGARMOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}.";
				}
				if ($data['color'] == 2) {
					$message = "ALÔ, SOU {$data['name']}, {$data['guidance']}, TENHO {$data['age']} ANOS E  MEUS CONTATOS SÃO ESSES: {$data['email']} / WHATSAPP: {$data['whatsapp']}, ESTOU AFIM DE {$data['interest']}.";
				}
				if ($data['color'] == 3) {
					$message = "ME CHAMO {$data['name']}, SOU {$data['guidance']}, TENHO {$data['age']} ANOS DE IDADE, EIS OS MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, ESTOU AFIM DE {$data['interest']}.";
				}
				if ($data['color'] == 4) {
					$message = "SOU {$data['name']}, {$data['guidance']}, TENHO {$data['age']} ANOS, EIS OS MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, QUERO {$data['interest']}.";
				}
				if ($data['color'] == 5) {
					$message = "MEU NOME É {$data['name']}, {$data['guidance']} TENHO {$data['age']} ANOS DE IDADE, AQUI VAI MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, TÔ AFIM DE: {$data['interest']}, PODES ME AJUDAR?";
				}
				if ($data['color'] == 6) {
					$message = "{$data['name']}, {$data['guidance']}, {$data['age']} ANOS, E-MAIL: {$data['email']} / WHATSAPP: {$data['whatsapp']}, MEU INTERESSE É EM: {$data['interest']}, ME PROCURE.";
				}
				if ($data['color'] == 7) {
					$message = "ME CHAMO {$data['name']}, SOU {$data['guidance']}, TENHO {$data['age']} ANOS, MEU E-MAIL É: {$data['email']} / MEU WHATSAPP É: {$data['whatsapp']}, E ESTOU AFIM DE: {$data['interest']}.";
				}
				if ($data['color'] == 8) {
					$message = "OI PESSOAL ! MEU NOME É {$data['name']}, SOU {$data['guidance']}, TENHO {$data['age']} ANOS DE IDADE, EIS MEUS CONTATOS: {$data['email']} / MEU WHATSAPP É: {$data['whatsapp']}, CASO TENHAM O MESMO INTERESSE QUE EU, OU SEJA, ESTOU BUSCANDO {$data['interest']}.";
				}
				if ($data['color'] == 9) {
					$message = "SOU {$data['name']}, SOU {$data['guidance']} E TENHO {$data['age']} ANOS DE IDADE, MEU E-MAIL E WHATS SÃO: {$data['email']} / {$data['whatsapp']}, ME PROCUREM, BUSCO {$data['interest']}.";
				}
				if ($data['color'] == 10) {
					$message = "{$data['name']}, {$data['guidance']}, {$data['age']} ANOS, COM OS SEGUINTES CONTATOS: {$data['email']} / {$data['whatsapp']}, BUSCA {$data['interest']}, AGUARDO SEU RETORNO.";
				}
				if ($data['color'] == 11) {
					$message = "ME CHAMO {$data['name']}, ME CONSIDERO {$data['guidance']}, MINHA IDADE É {$data['age']} ANOS, MEU E-MAIL E WHATS SÃO: {$data['email']} / {$data['whatsapp']}, INTERESSE {$data['interest']}, AGUARDO VOCÊ!";
				}
				if ($data['color'] == 12) {
					$message = "OI, ME CHAMO {$data['name']}, MINHA ORIENTAÇÃO SEXUAL É {$data['guidance']}, TENHO {$data['age']} ANOS. MEU E-MAIL É: {$data['email']} / E MEU WHATSAPP É: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}.";
				}
			}
		}

		return $message;
	}
}