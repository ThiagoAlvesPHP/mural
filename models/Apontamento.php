<?php
class Apontamento extends model{
	private $return;
	//cadatrar colaborador
	public function setApontamento($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
				$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_apontamento SET {$fields}");

		foreach ($post as $key => $value) {
				$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}

	//cadatrar colaborador
	public function upApontamento($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
				$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE cad_apontamento SET {$fields} WHERE id_apontamento = {$post['id_apontamento']}");

		foreach ($post as $key => $value) {
				$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}

	//contar registros de colaborador
	public function count($id_tarefa)
	{
		$sql = $this->db->query("
			SELECT COUNT(*) as c FROM cad_apontamento 
			WHERE id_colaborador = {$_SESSION['cLogin']} 
			AND id_tarefa = {$id_tarefa} 
		");

		return $sql->fetch(PDO::FETCH_ASSOC)['c'];
	}

	//contar registros de colaborador
	public function countApontamentoColaborador($id_colaborador)
	{
		$sql = $this->db->query("
			SELECT COUNT(*) as c FROM cad_apontamento 
			WHERE id_colaborador = {$id_colaborador}
		");

		return $sql->fetch(PDO::FETCH_ASSOC)['c'];
	}

	//consultar query 
	public function getAllSearch($sql) 
	{
		$sql = $this->db->query($sql);
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//somar horas do mês atual 
	public function sumTime($mes, $ano, $id_colaborador) 
	{
		$sql = $this->db->query("SELECT SUM(hora_apontamento) as sum FROM cad_apontamento WHERE MONTH(dt_registro) = {$mes} AND YEAR(dt_registro) = {$ano} AND id_colaborador = {$id_colaborador}");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	//cadastrar quadros de Tarefas
	public function setQuadrosTarefas($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_quadros_tarefas SET {$fields}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}

	//selecionar quadros
	public function getAllQuadrosTarefas() 
	{
		$sql = $this->db->query("SELECT * FROM cad_quadros_tarefas ORDER BY ordem");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//selecionar quadros
	public function getAllQuadrosAtivos() 
	{
		$sql = $this->db->query("SELECT * FROM cad_quadros_tarefas WHERE status = 1 ORDER BY ordem");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//selecionar quadros
	public function countQuadrosTarefas($id_quadro) 
	{
		$sql = $this->db->query("SELECT COUNT(*) as qt FROM cad_tarefas WHERE id_quadro = {$id_quadro}");
		return $sql->fetch(PDO::FETCH_ASSOC)['qt'];
	}

	//selecionar quadros
	public function getAllQuadrosTarefasAtivos() 
	{
		$sql = $this->db->query("SELECT * FROM cad_quadros_tarefas WHERE status = 1 ORDER BY ordem");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//cadastrar quadros de Tarefas
	public function upQuadrosTarefas($post)
	{
		$sql = $this->db->query("SELECT * FROM cad_quadros_tarefas WHERE ordem = {$post['ordem']} AND id_quadro != {$post['id_quadro']}");

		if ($sql->rowCount() == 0) {
			$fields = [];
			foreach ($post as $key => $value) {
				$fields[] = "$key=:$key";
			}
			$fields = implode(', ', $fields);
			$sql = $this->db->prepare("UPDATE cad_quadros_tarefas SET {$fields} WHERE id_quadro = {$post['id_quadro']}");

			foreach ($post as $key => $value) {
				$sql->bindValue(":{$key}", $value);
			}
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}

	//selecionar quadro
	public function getQuadro($id_quadro) 
	{
		$sql = $this->db->query("SELECT * FROM cad_quadros_tarefas WHERE id_quadro = {$id_quadro}");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	//cadastrar tarefas em quadro
	public function setTarefas($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_tarefas SET {$fields}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();

		return $this->db->lastInsertId();
	}
	//selecionar tarefa
	public function getTarefa($id_tarefa) 
	{
		$sql = $this->db->query("SELECT * FROM cad_tarefas WHERE id_tarefa = {$id_tarefa}");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//cadastrar tarefas em quadro
	public function upTarefas($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE cad_tarefas SET {$fields} WHERE id_tarefa = {$post['id_tarefa']}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}
	//selecionar colaboradores da tarefa
	public function getAllColaboradores($id_tarefa) 
	{
		$sql = $this->db->query("
			SELECT cc.nome 
			FROM cad_tarefas_colaboradores as ctc 
			INNER JOIN cad_colaboradores as cc 
			ON ctc.id_colaborador = cc.id_colaborador
			WHERE id_tarefa = {$id_tarefa}
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//cadastrar imagens de tarefa
	public function setTarefaImg($id_tarefa, $img)
	{
		$this->db->query("
			INSERT INTO cad_tarefas_imagens
			SET id_tarefa = {$id_tarefa},
			img = '{$img}'
			");
	}
	//cadastrar imagens de tarefa
	public function getAllTarefaImg($id_tarefa)
	{
		$sql = $this->db->query("
			SELECT id_tarefas_img, img FROM cad_tarefas_imagens
			WHERE id_tarefa = {$id_tarefa}
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//cadastrar imagens de tarefa
	public function getTarefaImg($id_tarefas_img)
	{
		$sql = $this->db->query("
			SELECT img FROM cad_tarefas_imagens
			WHERE id_tarefas_img = {$id_tarefas_img}
		");

		return $sql->fetch(PDO::FETCH_ASSOC)['img'];
	}
	//cadastrar imagens de tarefa
	public function delTarefaImg($id_tarefas_img)
	{
		$this->db->query("
			DELETE FROM cad_tarefas_imagens
			WHERE id_tarefas_img = {$id_tarefas_img}
		");
	}
	//insert historico tarefa quadros
	public function setTarefaQuadro($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_tarefas_quadro SET {$fields}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}
	//selecionar historico de quadros em tarefa
	public function getHistoricoTarefa($id_tarefa)
	{
		$sql = $this->db->query("
			SELECT ctq.dt_registro, cqt.quadro, cc.nome 
			FROM cad_tarefas_quadro as ctq 
			INNER JOIN cad_quadros_tarefas as cqt 
			ON ctq.id_quadro = cqt.id_quadro
			INNER JOIN cad_colaboradores as cc
			ON ctq.id_colaborador = cc.id_colaborador
			WHERE id_tarefa = {$id_tarefa}
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//selecionar tarefas do quadro
	public function getAllTarefas($id_quadro) 
	{
		$sql = $this->db->query("SELECT * FROM cad_tarefas WHERE id_quadro = {$id_quadro}");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	//selecionar valor do id_tarefa da ultima tarefa
	public function getEndValueTarefa()
	{
		$sql = $this->db->query("SELECT id_tarefa FROM cad_tarefas ORDER BY id_tarefa DESC");
		return $sql->fetch(PDO::FETCH_ASSOC)['id_tarefa'];
	}
	//cadastrar vinculo de colaborador com tarefa
	public function setTarefaVinculo($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_tarefas_colaboradores SET {$fields}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}

	//selecionar valor do id_tarefa da ultima tarefa
	public function getTarefaVinculo($id_tarefa, $id_colaborador)
	{
		$sql = $this->db->query("
			SELECT * FROM cad_tarefas_colaboradores 
			WHERE id_tarefa = {$id_tarefa}
			AND id_colaborador = {$id_colaborador}
		");

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	//revomer vinculo de tarefa
	public function delTarefaVinculo($id_tarefa, $id_colaborador)
	{
		$this->db->query("
			DELETE FROM cad_tarefas_colaboradores 
			WHERE id_tarefa = {$id_tarefa}
			AND id_colaborador = {$id_colaborador}
		");
	}

}