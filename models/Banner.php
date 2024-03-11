<?php
class Banner extends model
{

	const TABLE = "banners";

	/**
	 * find
	 */
	public function find($id)
	{
		$sql = $this->db->query("
			SELECT * FROM " . self::TABLE . " 
			WHERE id = '{$id}' 
		");

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
		$sql = $this->db->prepare("INSERT INTO " . self::TABLE . " SET {$fields}");

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
			UPDATE " . self::TABLE . " 
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
		$sql = $this->db->query("SELECT * FROM " . self::TABLE . "");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listActive()
	{
		$sql = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE is_active = 1");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * delete
	 */
	public function delete($id)
	{
		$sql = $this->db->query("DELETE FROM " . self::TABLE . " WHERE id = '{$id}'");
	}
}
