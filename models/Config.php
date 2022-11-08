<?php
class Config extends model{
	//selecionar dados de cliente
	public function get(){
		$sql = $this->db->query("SELECT * FROM cad_config");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//atualizar cliente
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE cad_config 
			SET {$fields}
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}

	//cargos
	public function getAllCargos() {
		$sql = $this->db->query("SELECT * FROM cad_cargos");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//acordo
	public function getAllAcordo() {
		$sql = $this->db->query("SELECT * FROM cad_acordo");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//definição
	public function getAllDefinicao() {
		$sql = $this->db->query("SELECT * FROM cad_definicao");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//status nf
	public function getAllsStatusNf() {
		$sql = $this->db->query("SELECT * FROM cad_status_nf");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	
}