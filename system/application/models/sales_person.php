<?php 

	class Sales_person extends Model
	{
		function CheckAndRetrieveLogin( $username, $password)
		{
			$sql = "SELECT * FROM sales_persons WHERE username = ? AND password = ?";
			
			return $this->db->query( $sql, array( $username, $password ) )->row();
		}
		
		function ChangePassword( $username, $old_password, $new_password )
		{
			$user = $this->CheckAndRetrieveLogin( $username, $old_password );
			
			if( !$user )
			{
				return false;
			}
			
			$data = array ( 'password' => $new_password );
			
			$this->db->where( 'username', $username );
			$this->db->update( 'sales_persons', $data );
			
			return true;
		}
	}

?>