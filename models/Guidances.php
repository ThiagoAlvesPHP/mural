<?php
class Guidances extends model{

	const TABLE = "guidance";
	
	/**
	 * find
	 */
	public function find($id){
		$sql = $this->db->query("
			SELECT * FROM ".Guidances::TABLE." 
			WHERE id = '{$id}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	/**
	 * register
	 */
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO ".Guidances::TABLE." SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	/**
	 * update
	 */
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE ".Guidances::TABLE." 
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
		$sql = $this->db->query("SELECT * FROM ".Guidances::TABLE."");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * delete
	 */
	public function delete($id){
		$sql = $this->db->query("DELETE FROM ".Guidances::TABLE." WHERE id = '{$id}'");
	}
	/**
	 * validate color
	 */
	public function validate($title)
	{
		$sql = $this->db->query("SELECT * FROM ".Guidances::TABLE." WHERE title = '{$title}'");

		return ($sql->rowCount() == 0)?true:false;
	}
}