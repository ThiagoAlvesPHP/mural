<?php
class Mural extends model
{

	const TABLE = "mural";

	/**
	 * find
	 */
	public function find($id)
	{
		$sql = $this->db->query("
			SELECT * FROM " . Mural::TABLE . " 
			WHERE id = '{$id}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * find
	 */
	public function searchEmail($email)
	{
		$sql = $this->db->prepare("
			SELECT * FROM " . Mural::TABLE . " 
			WHERE email = :email
			ORDER BY id DESC
		");
		$sql->bindValue(":email", $email);
		$sql->execute();

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * register
	 */
	public function set($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO " . Mural::TABLE . " SET {$fields}");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}
	/**
	 * update
	 */
	public function up($post)
	{
		$fields = [];
		foreach ($post as $key => $value) {
			$fields[] = "$key=:$key";
		}
		$fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE " . Mural::TABLE . " 
			SET {$fields}
			WHERE id = '{$post['id']}'
		");

		foreach ($post as $key => $value) {
			$sql->bindValue(":{$key}", $value);
		}
		$sql->execute();
	}
	/**
	 * List
	 */
	public function list()
	{
		$sql = $this->db->query("SELECT * FROM " . Mural::TABLE . "");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * List
	 */
	public function listByIds($idArray)
	{
		$inClause = implode(',', array_fill(0, count($idArray), '?'));

		$sql = $this->db->prepare("SELECT * FROM " . Mural::TABLE . " WHERE id IN :ids");
		$sql = $this->db->prepare("SELECT * FROM " . Mural::TABLE . " WHERE id IN ($inClause)");

		// Execute a consulta, vinculando cada valor do array
		foreach ($idArray as $key => $value) {
			$sql->bindValue(($key + 1), $value, PDO::PARAM_INT);
		}

		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * list pending
	 */
	public function listPending()
	{
		$sql = $this->db->query("SELECT * FROM " . Mural::TABLE . " WHERE status = 0");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * list aproved
	 */
	public function listApproved()
	{
		$date = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
		$sql = "SELECT * FROM " . Mural::TABLE . " WHERE ((status = 1 AND DATE(created_at) >= '" . $date . "') OR is_infinite = 1) AND is_old = 0 AND is_mode_third = 0";
		// var_dump($sql);
		// exit;
		$sql = $this->db->query($sql);
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * List
	 */
	public function listOld()
	{
		$sql = $this->db->query("SELECT * FROM " . Mural::TABLE . " WHERE is_old = 1");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * delete
	 */
	public function delete($id)
	{
		$this->db->query("DELETE FROM " . Mural::TABLE . " WHERE id = '{$id}'");
	}

	/**
	 * delete
	 */
	public function deleteAll()
	{
		$this->db->query("DELETE FROM " . Mural::TABLE);
	}
	/**
	 * validate color
	 */
	public function validate($title)
	{
		$sql = $this->db->query("SELECT * FROM " . Mural::TABLE . " WHERE title = '{$title}'");

		return ($sql->rowCount() == 0) ? true : false;
	}
	/**
	 * clean
	 */
	public function clean($date)
	{
		$sql = "UPDATE " . Mural::TABLE . " SET is_old = " . true . " WHERE DATE(created_at) <= :date AND is_infinite = :is_infinite";
		$query = $this->db->prepare($sql);
		$query->bindValue(":date", $date);
		$query->bindValue(":is_infinite", false);
		$query->execute();
	}
}
