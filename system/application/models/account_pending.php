<?php

	class Account_pending extends MY_Model
	{
		function Create( $site_name, $admin_password, $email, $coupon_code, $purchase_price, $is_trial )
		{
			$data = array(
							'site_name' => $site_name,
							'admin_password' => $admin_password, 
							'email' => $email, 
							'coupon_code' => $coupon_code,
							'purchase_price' => $purchase_price,
							'is_trial' => $is_trial,
							'created' => $this->getMySQLDateTime()
						);
						
			$this->db->insert( 'accounts_pending', $data );
			
			return $this->db->insert_id();
		}
		
		function DeleteAll()
		{
			$sql = "TRUNCATE accounts_pending";
			$this->db->query( $sql );
		}
		
		function DeleteByEmail( $email )
		{
			$sql = "DELETE FROM accounts_pending WHERE email = ?";
			
			$this->db->query( $sql, array( $email ) );
		}

		function DeleteAllCreatedHoursAgo( $hours_tolerance )
		{
			$sql = "DELETE FROM accounts_pending WHERE 
					 DATE_SUB( NOW(), INTERVAL $hours_tolerance HOUR) > created";
					
			$this->db->query( $sql );
		}
		
		function DeleteBySiteName( $site_name )
		{
			$sql = "DELETE FROM accounts_pending WHERE site_name = ?";
			
			$this->db->query( $sql, array( $site_name ) );
		}
		
		function GetByEmail( $email )
		{
			$sql = "SELECT * FROM accounts_pending WHERE email = ?";
			
			return $this->db->query( $sql, array( $email ) )->row();			
		}	
		
		function GetBySiteName( $site_name )
		{
			$sql = "SELECT * FROM accounts_pending WHERE site_name = ?";
			
			return $this->db->query( $sql, array( $site_name ) )->row();			
		}
		
		
		function DoesPendingSiteExist( $site_name )
		{
			$sql = "SELECT id FROM accounts_pending WHERE site_name = ?";
			
			$result = $this->db->query( $sql, array( $site_name ) );
			
			return (($result->num_rows() > 0) ? true : false);		
		}
	
	}

?>