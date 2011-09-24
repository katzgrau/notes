<?php

	class Coupon extends MY_Model
	{
		function Create( $code, $after_price, $comment, $is_single_use, $is_trial, $sales_person, $days_expiration)
		{
			$data = array(
							'code' => $code,
							'after_price' => $after_price,
							'comment' => $comment,
							'is_active' => true,
							'is_single_use' => $is_single_use,
							'is_trial' => $is_trial,
							'sales_person' => $sales_person,
							'term_expiration' => $days_expiration,
							'created' => $this->getMySQLDateTime()
						);
						
			$this->db->insert( 'coupons', $data );
			
			return $this->db->insert_id();
		}
		
		function DeleteAll()
		{
			$sql = "TRUNCATE coupons";
			$this->db->query( $sql );
		}
		
		function GetByCode( $code )
		{
			$sql = "SELECT * FROM coupons WHERE code = ?";
			
			return $this->db->query( $sql, array( $code ) )->row();			
		}

		function GetActiveCouponsByCode( $code )
		{
			$sql = "SELECT * FROM coupons WHERE code = ? AND is_active = 1";
			
			return $this->db->query( $sql, array( $code ) )->row();			
		}
		
		function GetBySalesPersonId( $id )
		{
			$sql = "SELECT * FROM coupons WHERE sales_person = $id";
			
			return $this->db->query( $sql, array( $id ) )->result();
		}
		
		function Deactivate( $sales_id, $coupon_code )
		{
			$sql = "UPDATE coupons SET is_active = 0 WHERE sales_person = ? AND code = ?";
			
			$this->db->query( $sql, array( $sales_id, $coupon_code ) );
		}
		
		function Reactivate( $sales_id, $coupon_code )
		{
			$sql = "UPDATE coupons SET is_active = 1 WHERE sales_person = ? AND code = ?";
			
			$this->db->query( $sql, array( $sales_id, $coupon_code ) );
		}
		
		function GetTopCouponInfo( $limit = 10 )
		{
			$sql = "SELECT (SELECT COUNT(*) FROM accounts WHERE signup_coupon_code = c.code) as 'number_used',
							c.code, sp.username, c.created
					FROM coupons c, sales_persons sp
					WHERE c.sales_person = sp.id
					ORDER BY number_used DESC
					LIMIT 0, ?";
					
			return $this->db->query( $sql, array( $limit ) )->result();
		}
	
	}

?>