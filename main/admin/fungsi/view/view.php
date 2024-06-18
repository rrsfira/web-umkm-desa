<?php
/*
	 * PROSES TAMPIL  
	 */
class view
{
	protected $db;
	function __construct($db)
	{
		$this->db = $db;
	}


	function admin()
	{
		$sql = "select*from user_form";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();
		return $hasil;
	}
	function users_row(){
		$sql = "select*from users";
		$row = $this-> db -> prepare($sql);
		$row -> execute();
		$hasil = $row -> rowCount();
		return $hasil;
	}
	function userform_row(){
		$sql = "select*from user_form";
		$row = $this-> db -> prepare($sql);
		$row -> execute();
		$hasil = $row -> rowCount();
		return $hasil;
	}

}
