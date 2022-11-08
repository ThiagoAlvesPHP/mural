<?php
class Colaborador extends model{
	private $table = "cad_colaboradores";
	//verificar se esta logado
	public function verificarLogado()
	{
		if (!empty($_SESSION['cLogin'])) {
			return true;
		} else {
			return false;
		}
	}
	//fazer login de colaborador
	public function login($post)
	{
		$sql = $this->db->prepare('
			SELECT * FROM cad_colaboradores 
			WHERE login = :login
			AND senha = :senha
		');
		$sql->bindValue(':login', $post['login']);
		$sql->bindValue(':senha', md5($post['senha']));
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			if ($dados['status'] == 1) {
				$_SESSION['cLogin'] = $dados['id_colaborador'];
				return 1;		
			} else {
				return 2;
			}
		} else {
			return 3;
		}
	}
	//cadatrar colaborador
	public function set($post)
	{
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO {$this->table} SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();

		return $this->db->lastInsertId();
	}
	//atualizar colaborador
	public function up($post)
	{
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE {$this->table} 
			SET {$fields}
			WHERE id_colaborador = '{$post['id_colaborador']}'
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//registrar mudança de status de colaborador
	public function upStatusCol($id_colaborador, $status) 
	{	
		$this->db->query("INSERT INTO cad_status_colaborador SET id_colaborador = {$id_colaborador}, status = {$status}");
	}
	//selecionar data de desligamento
	public function getStatusCol($id_colaborador)
	{
		$sql = $this->db->query("SELECT * FROM cad_status_colaborador WHERE id_colaborador = {$id_colaborador}");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//selecionar dados de cliente
	public function get($id)
	{
		$sql = $this->db->query("
			SELECT 
			c.*, 
			a.titulo,
			cargo.titulo as cargo
			FROM {$this->table} as c 
			INNER JOIN cad_acordo as a 
			ON c.id_acordo = a.id_acordo 
			INNER JOIN cad_cargos as cargo
			ON c.id_cargo = cargo.id_cargo		
			WHERE c.id_colaborador = '{$id}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	//selecionar dados de cliente
	public function getAll()
	{
		$sql = $this->db->query("
			SELECT 
			c.*, 
			a.titulo,
			cargo.titulo as cargo,
			d.titulo as definicao
			FROM {$this->table} as c 
			INNER JOIN cad_acordo as a 
			ON c.id_acordo = a.id_acordo 
			INNER JOIN cad_cargos as cargo
			ON c.id_cargo = cargo.id_cargo
			INNER JOIN cad_definicao as d
			ON c.id_definicao = d.id_definicao
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//verificar se usuario logado é admin
	public function getVerAdmin($id)
	{
		$sql = $this->db->query("
			SELECT id_definicao 
			FROM {$this->table}		
			WHERE id_colaborador = '{$id}' 
		");
		$usuario = $sql->fetch(PDO::FETCH_ASSOC);

		if($usuario['id_definicao'] == '1') {
			return true;
		} else {
			return false;
		}
	}
}