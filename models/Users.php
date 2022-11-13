<?php
class Users extends model 
{
	
	const TABLE = "users";

	/**
	 * Login user
	 */
	public function login($post){
		$sql = $this->db->prepare("
			SELECT id FROM ".Users::TABLE." 
			WHERE email = :email
			AND pass = :pass
		");
		$sql->bindValue(':email', $post['email']);
		$sql->bindValue(':pass', md5($post['pass']));
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			$_SESSION['cLogin'] = $dados['id'];
			return true;
		} else {
			return false;
		}
	}
	/**
	 * verifiy user logado
	 */
	public function logado()
	{
		if (!isset($_SESSION['cLogin'])) {
			header('Location: '.BASE);
		}
	}
	/**
	 * find
	 */
	public function find($id){
		$sql = $this->db->query("
			SELECT * FROM ".Users::TABLE." 
			WHERE id = '{$id}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	//dados do config
	public function verificarEmail($email){
		$sql = $this->db->query("
			SELECT * FROM ".Users::TABLE." 
			WHERE email = '{$email}' 
		");

		if ($sql->rowCount() == 0) {
			return true;
		} else {
			return false;
		}
	}
	//cadatrar cliente
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO ".Users::TABLE." SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();

		return $this->db->lastInsertId();
	}
	//atualizar cliente
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE ".Users::TABLE." 
			SET {$fields}
			WHERE id = '{$post['id']}'
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}

	/**
	 * update all mode
	 */
	public function update($post)
	{
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE ".Users::TABLE." 
			SET {$fields}
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	/**
	 * find mode
	 */
	public function findMode()
	{
		$sql = "SELECT mode FROM ".Users::TABLE."";
		$sql = $this->db->query($sql);
		// var_dump($sql);
		// exit;
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
}