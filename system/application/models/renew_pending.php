<?php 

	class Renew_pending extends MY_Model
	{
		function Create( $account_id, $purchase_price, $coupon_code )
		{
			/* First, clear out any lingering pending accounts */
			$this->DeleteByAccountId( $account_id );
			
			$data = array( 
						'account_id' => $account_id,
						'purchase_price' => $purchase_price,
						'coupon_code' => $coupon_code,
						'created' => $this->getMySQLDateTime()
					);
					
			$this->db->insert('renews_pending', $data);
		}
		
		function GetByAccountId( $id )
		{
			$sql = "SELECT * FROM renews_pending WHERE account_id = ?";
			
			return $this->db->query( $sql, array ( $id ) )->row();
		}
		
		function DeleteByAccountId( $acct_id )
		{
			$sql = "DELETE FROM renews_pending WHERE account_id = ?";
			
			$this->db->query( $sql, array ( $acct_id ) );
		}
	}

?>