<?php
class homeController extends controller
{
	protected $array = [];
	protected $post;
	protected $get;
	protected $user;
	protected $guidances;
	protected $interests;
	protected $mural;
	protected $Sign;
	protected $blockEmailIp;
	protected $banner;
	protected $interestPrimary;

	public function __construct()
	{
		$this->post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$this->user = new Users();
		$this->guidances = new Guidances();
		$this->interests = new Interest();
		$this->mural = new Mural();
		$this->Sign = new Sign();
		$this->blockEmailIp = new BlockEmailIp();
		$this->banner = new Banner();
		$this->interestPrimary = new InterestPrimary();

		$date = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
		$this->mural->clean($date);
	}

	public function index()
	{
		$this->array['guidances'] = $this->guidances->list();
		$this->array['interests'] = $this->interests->list();
		$this->array['interests_primary'] = $this->interestPrimary->list();
		$this->array['signs'] = $this->Sign->list();
		$this->array['colors'] = $this->colors();
		$this->array['success'] = (isset($this->get['success'])) ? true : false;
		$this->array['banners'] = $this->banner->listActive();
		$url = explode('.', $_SERVER['HTTP_HOST']);

		// if ($url[0] == "www") {
		// 	header("Location: ".BASE);
		// }
		// if (!isset($_SERVER['HTTPS'])) {
		// 	header("Location: ".BASE);
		// }

		if (!empty($this->get['id']) && !empty(explode(":", $this->get['id'])[0])) {
			$id = base64_decode(explode(":", $this->get['id'])[0]);
			$find = $this->mural->find($id);
			$this->array['find'] = $find;
		}

		$this->array['listApproved'] = $this->mural->listApproved();
		$this->array['listOld'] = $this->mural->listOld();

		$this->loadTemplate('home', $this->array);
	}

	/**
	 * register public
	 */
	public function register()
	{
		if (!empty($this->post)) {
			$mode = $this->user->findMode();
			$this->post['ip'] = $_SERVER['REMOTE_ADDR'];
			$serach = $this->blockEmailIp->serach($this->post['email'], $this->post['ip']);

			if (count($serach) > 0) {
				$_SESSION['alert'] = [
					"class"		=> "warning",
					"message"	=> "E-mail e IP bloqueado!"
				];
				header('Location: ' . BASE);
				exit;
			}

			$this->post = array_filter($this->post);
			$this->post['color'] = $_POST['color'];
			$this->post['age'] = (!empty($this->post['age'])) ? $this->post['age'] : $this->post['age_text'];
			unset($this->post['age_text']);
			$this->post['message'] = $this->message($this->post);

			if (!empty($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
				$extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				// Verifica se a extensão é PNG ou JPG
				if (in_array(strtolower($extension), array('png', 'jpg', 'jpeg'))) {
					$photo = md5(uniqid(rand(), true));
					$photo = $photo . '.' . $extension;
					$path = 'assets/img/mural/' . $photo;

					move_uploaded_file($_FILES['photo']['tmp_name'], $path);
					$this->post['photo'] = $path;
				} else {
					$_SESSION['alert'] = [
						"class"		=> "warning",
						"message"	=> "Error ao enviar seus dados, verifique as informações enviadas e formato de foto!"
					];
					header('Location: ' . BASE);
					exit;
				}
			}

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
			$this->post['guidance_id'] = explode(":", $this->post['guidance'])[0];
			$this->post['guidance'] = explode(":", $this->post['guidance'])[1];
			$this->post['interest_id'] = explode(":", $this->post['interest'])[0];
			$this->post['interest'] = explode(":", $this->post['interest'])[1];
			$this->post['interest_primary_id'] = explode(":", $this->post['interest_primary'])[0];
			$this->post['interest_primary'] = explode(":", $this->post['interest_primary'])[1];
			$this->post['is_mode_third'] = "0";

			$this->mural->set($this->post);

			$_SESSION['alert'] = [
				"class"		=> "success",
				"message"	=> "Sua mensagem esta em processo de aprovação. Aguarde!' : 'Sua mensagem foi puclicada com sucesso! - Em 07 dias ela será excluída! - <p>Algumas mensagens podem ser premiadas ficando mais tempo no ar</p>"
			];

			header('Location: ' . BASE . '?success=true');
			exit;
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
		$this->array['error'] = (isset($this->get['error'])) ? true : false;

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
				header('Location: ' . BASE . 'admin');
				exit;
			} else {
				header('Location: ' . BASE . 'home/login?error=true&data=' . base64_encode(json_encode($this->post)));
				exit;
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
			],
			[
				'color'	=> '#834d2b'
			],
			[
				'color'	=> '#a9a7aa'
			],
			[
				'color'	=> '#818386'
			],
			[
				'color'	=> '#efd6b8'
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
		$data['guidance'] = explode(":", $data['guidance'])[1];

		foreach ($this->colors() as $key => $value) {
			if ($key == $data['color']) {
				if ($data['color'] == 0) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "OI, ME CHAMO {$data['name']}, MINHA ORIENTAÇÃO SEXUAL É {$data['guidance']}, {$age}. MEU E-MAIL É: {$data['email']} / E MEU WHATSAPP É: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}, MORO EM {$data['city']}.";
				}
				if ($data['color'] == 1) {
					$age = (is_numeric($data['age'])) ? "MINHA IDADE É {$data['age']} ANOS" : $data['age'];

					$message = "OLÁ, MEU NOME É {$data['name']}, TENHO POR ORIENTAÇÃO SEXUAL A CLASSIFICAÇÃO {$data['guidance']}, {$age}. E AQUI VÃO OS MEUS CONTATOS PARA NOS LIGARMOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}, RESIDO EM {$data['city']} .";
				}
				if ($data['color'] == 2) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "ALÔ, SOU {$data['name']}, {$data['guidance']}, {$age} E  MEUS CONTATOS SÃO ESSES: {$data['email']} / WHATSAPP: {$data['whatsapp']}, ESTOU AFIM DE {$data['interest']}, SOU DE {$data['city']}.";
				}
				if ($data['color'] == 3) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS DE IDADE" : $data['age'];

					$message = "ME CHAMO {$data['name']}, SOU {$data['guidance']}, {$age}, EIS OS MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, ESTOU AFIM DE {$data['interest']}, VIVO EM {$data['city']}.";
				}
				if ($data['color'] == 4) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "SOU {$data['name']}, {$data['guidance']}, {$age}, EIS OS MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, QUERO {$data['interest']}, MORO EM {$data['city']}.";
				}
				if ($data['color'] == 5) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS DE IDADE" : $data['age'];

					$message = "MEU NOME É {$data['name']}, {$data['guidance']} {$age}, AQUI VAI MEUS CONTATOS: {$data['email']} / WHATSAPP: {$data['whatsapp']}, TÔ AFIM DE: {$data['interest']}, SOU DE {$data['city']}, PODES ME AJUDAR?";
				}
				if ($data['color'] == 6) {
					$age = (is_numeric($data['age'])) ? "{$data['age']} ANOS" : $data['age'];

					$message = "{$data['name']}, {$data['guidance']}, {$age}, E-MAIL: {$data['email']} / WHATSAPP: {$data['whatsapp']}, MEU INTERESSE É EM: {$data['interest']}, RESIDO EM {$data['city']}, ME PROCURE.";
				}
				if ($data['color'] == 7) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "ME CHAMO {$data['name']}, SOU {$data['guidance']}, {$age}, MEU E-MAIL É: {$data['email']} / MEU WHATSAPP É: {$data['whatsapp']}, E ESTOU AFIM DE: {$data['interest']}, VIVO EM {$data['city']}.";
				}
				if ($data['color'] == 8) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS DE IDADE" : $data['age'];

					$message = "OI PESSOAL ! MEU NOME É {$data['name']}, SOU {$data['guidance']}, {$age}, EIS MEUS CONTATOS: {$data['email']} / MEU WHATSAPP É: {$data['whatsapp']}, CASO TENHAM O MESMO INTERESSE QUE EU, OU SEJA, ESTOU BUSCANDO {$data['interest']}, SOU DE {$data['city']}.";
				}
				if ($data['color'] == 9) {
					$age = (is_numeric($data['age'])) ? "E TENHO {$data['age']} ANOS DE IDADE" : $data['age'];

					$message = "SOU {$data['name']}, SOU {$data['guidance']} {$age}, MEU E-MAIL E WHATS SÃO: {$data['email']} / {$data['whatsapp']}, ME PROCUREM, BUSCO {$data['interest']}, MORO EM {$data['city']}.";
				}
				if ($data['color'] == 10) {
					$age = (is_numeric($data['age'])) ? "{$data['age']} ANOS" : $data['age'];

					$message = "{$data['name']}, {$data['guidance']}, {$age}, COM OS SEGUINTES CONTATOS: {$data['email']} / {$data['whatsapp']}, BUSCA {$data['interest']}, AGUARDO SEU RETORNO, RESIDO EM {$data['city']}.";
				}
				if ($data['color'] == 11) {
					$age = (is_numeric($data['age'])) ? "MINHA IDADE È {$data['age']} ANOS" : $data['age'];

					$message = "ME CHAMO {$data['name']}, ME CONSIDERO {$data['guidance']}, {$age}, MEU E-MAIL E WHATS SÃO: {$data['email']} / {$data['whatsapp']}, INTERESSE {$data['interest']}, VIVO EM {$data['city']}, AGUARDO VOCÊ!";
				}
				if ($data['color'] == 12) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "OI, ME CHAMO {$data['name']}, MINHA ORIENTAÇÃO SEXUAL É {$data['guidance']}, {$age}. MEU E-MAIL É: {$data['email']} / E MEU WHATSAPP É: {$data['whatsapp']}, TENHO INTERESSE EM {$data['interest']}, SOU DE {$data['city']}.";
				}

				if ($data['color'] == 13) {
					$age = (is_numeric($data['age'])) ? "MINHA IDADE È {$data['age']} ANOS" : $data['age'];

					$message = "ATENÇÃO PESSOAL, AQUI ESCREVE {$data['name']}, EU SOU {$data['guidance']}, {$age}. AQUI ESTA MEU E-MAIL: {$data['email']} / E MEU WHATSAPP É: {$data['whatsapp']}, ESTOU COM VONTADE DE {$data['interest']}, SOU DE {$data['city']}.";
				}
				if ($data['color'] == 14) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS" : $data['age'];

					$message = "ME CHAMO {$data['name']}, COM A ORIENTAÇÃO {$data['guidance']}, {$age}. MEU E-MAIL: {$data['email']}, MEU WHATSAPP É: {$data['whatsapp']}, TENHO A INTENÇÃO DE {$data['interest']}, MORO EM {$data['city']}.";
				}
				if ($data['color'] == 15) {
					$age = (is_numeric($data['age'])) ? "TENHO {$data['age']} ANOS DE IDADE" : $data['age'];

					$message = "PESSOAL, AQUI ESCREVE {$data['name']}, CERTAMENTE SOU {$data['guidance']}, {$age}. ME PROCUREM EM E-MAIL: {$data['email']}, WHATSAPP É: {$data['whatsapp']}, GOSTARIA DE {$data['interest']}, RESIDO EM {$data['city']}.";
				}
				if ($data['color'] == 16) {
					$age = (is_numeric($data['age'])) ? "MINHA IDADE È {$data['age']} ANOS" : $data['age'];

					$message = "ENTÃO GALERA, EU {$data['name']}, SOU {$data['guidance']}, {$age}. ENTRE EM CONTATO VIA E-MAIL E/OU WHATS; O MEU E-MAIL É: {$data['email']}, E MEU WHATSAPP É: {$data['whatsapp']}, ESTOU SUPER AFIM DE {$data['interest']}, VIVO EM {$data['city']}.";
				}
			}
		}

		return $message;
	}

	/**
	 * republicar mural
	 */
	public function muralUpdate()
	{
		$data = $this->mural->searchEmail($this->post['email']);

		$this->array['status'] = $data ? true : false;
		$this->array['message'] = $data ? "Encontramos uma publicação!" : "Não localizamos nenhuma publicação com o e-mail inserido.";
		$this->array['id'] = $data ? base64_encode($data['id']) . ":" . md5(time() . rand(999, 9999)) : false;

		echo json_encode($this->array);
	}
}
