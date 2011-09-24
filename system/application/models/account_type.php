<?php 

	class Account_type extends MY_Model
	{
		function GetById( $id )
		{
			$sql = "SELECT * FROM account_types WHERE id = ?";
			
			return $this->db->query( $sql, $id )->row();
		}
	}
	
?>