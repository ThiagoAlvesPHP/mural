<?php
class Interest extends model
{

	const TABLE = "interest";

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
		$sql = $this->db->query("SELECT i.*, ip.name FROM " . self::TABLE . " as i LEFT JOIN ".InterestPrimary::TABLE." as ip ON i.interest_primary_id = ip.id");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * delete
	 */
	public function delete($id)
	{
		$sql = $this->db->query("DELETE FROM " . self::TABLE . " WHERE id = '{$id}'");
	}
	/**
	 * validate color
	 */
	public function validate($title)
	{
		$sql = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE title = '{$title}'");

		return ($sql->rowCount() == 0) ? true : false;
	}
}
