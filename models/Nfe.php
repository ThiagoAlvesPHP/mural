<?php
class Nfe extends model{
	//selecionar dados de cliente
	public function getMesAno($mes, $ano, $id_colaborador){
        $sql = "
            SELECT * FROM cad_notas 
            WHERE id_colaborador = {$id_colaborador}
            AND MONTH(dt_registro) = {$mes}
            AND YEAR(dt_registro) = {$ano}
        ";
		$sql = $this->db->query($sql);
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	public function getAllCol($id_colaborador){
        $sql = "
			SELECT
			c.*, 
			tp.titulo as tipo_pag,
			csn.titulo as status_nf 
			FROM cad_notas as c
			INNER JOIN cad_tipo_pag as tp
			ON c.id_tipo_pag = tp.id_tipo_pag
			INNER JOIN cad_status_nf as csn
			ON c.status = csn.id_status
			WHERE c.id_colaborador = {$id_colaborador}
			ORDER BY c.dt_registro DESC
        ";
		$sql = $this->db->query($sql);
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//cadatrar nfe
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_notas SET {$fields}");
		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//atualizar cliente
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE cad_notas 
			SET {$fields}
			WHERE id_nota = {$post['id_nota']}
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}

	//alteração de status de nf
	public function upStatus($id_nota) {
		$this->db->query("
			UPDATE cad_notas 
			SET status = 1, status_pag = 1
			WHERE id_nota = {$id_nota}
		");
	}
	
}