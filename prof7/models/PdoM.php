<?php

class PdoM
{
	private static $instance;
	private $db;

	public static function Instance()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		setlocale(LC_ALL, 'ru_RU.UTF8');
		$this->db = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		$this->db->exec('SET NAMES UTF8');
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	public function Select($table, $string_with_attrs, $where_attr, $bind)
	{
		$query = "SELECT $string_with_attrs FROM $table" . $where_attr . ";";
		$q = $this->db->prepare($query);
		$q->execute($bind);

		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->fetch();
	}

	public function Select_All($table, $string_with_attrs, $where_attr, $bind)
	{
		$query = "SELECT $string_with_attrs FROM $table" . $where_attr . ";";
		$q = $this->db->prepare($query);
		$q->execute($bind);

		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->fetchAll();
	}

	public function Insert($table, $columns, $values)
	{
		$query = "INSERT INTO $table ($columns) VALUES ($values);";
		$q = $this->db->prepare($query);
		$q->execute();

		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->errorCode();
	}

	public function Update($table, $arr_assoc, $where, $bind_upd)
	{
		$values = implode(', ', $arr_assoc);
		$query = "UPDATE $table SET $values" . $where . ";";
		$q = $this->db->prepare($query);
		$q->execute($bind_upd);

		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->errorCode();
	}

	public function Delete($table, $where)
	{
		$query = "DELETE FROM $table WHERE $where";
		$q = $this->db->prepare($query);
		$q->execute();

		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}

		return $q->rowCount();
	}
}
