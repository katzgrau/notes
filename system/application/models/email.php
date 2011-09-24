<?php 

	class Email extends MY_Model
	{
		function GetEmails()
		{
			$sql = "SELECT * from emails WHERE active = 1";
			
			return $this->db->query( $sql )->result();
		}
		
		function Create( $to, $subject, $message )
		{
			$data = array 	(
								'to' => $to,
								'subject' => $subject,
								'message' => $message,
								'attempts' => 0,
								'active' => 1,
								'created' => $this->getMySQLDateTime()
							);
			
			$this->db->insert('emails', $data);
		}
		
		function DeleteEmails( $arr_ids )
		{
			$id_list = implode( ',', $arr_ids );
			
			$sql = "DELETE FROM emails WHERE id IN ( $id_list )";
			
			return $this->db->query ( $sql );
		}		
		
		function DeleteAllEmailsExcept( $arr_ids )
		{
			if( sizeof ( $arr_ids ) == 0 )
			{
				$sql = "TRUNCATE emails";
				$this->db->query ( $sql );
			}
			else
			{
				$id_list = implode( ',', $arr_ids );
				$sql = "DELETE FROM emails WHERE id NOT IN ( $id_list )";
				
				$this->db->query ( $sql );
			}
			
			return true;
		}
		
		function IncrementFailureCounts( $arr_ids )
		{
			if( sizeof ( $arr_ids ) > 0 )
			{
				$id_list = implode( ',', $arr_ids );
				
				$sql = "UPDATE emails SET attempts = attempts + 1 
						WHERE id IN ( $id_list )";
						
				$this->db->query ( $sql );
				
				$sql = "UPDATE emails SET active = 0 WHERE attempts >= " . config_item('mail_max_send_attempts');	
				$this->db->query ( $sql );
			}
		}
	}

?>