<?php

	class Account extends MY_Model
	{
		function Create( $account_type_id, $group_id, $user_id, $signup_coupon_code, $starting_cost, $discount, $payment_expiration, $comments )
		{
			$data = array 	(
								'account_type_id' 		=> $account_type_id,
								'group_id' 				=> $group_id,
								'user_id' 				=> $user_id,
								'signup_coupon_code' 	=> $signup_coupon_code,
								'starting_cost' 		=> $starting_cost,
								'discount' 				=> $discount,
								'payment_expiration' 	=> $payment_expiration,
								'comments' 				=> $comments,
								'created' 				=> $this->getMySQLDateTime(),
								'modified' 				=> $this->getMySQLDateTime()
							);
			
			$this->db->insert('accounts', $data);
		}
		
		function GetByUserId( $user_id )
		{
			$sql = "SELECT * FROM accounts WHERE user_id = ?";
			
			return $this->db->query( $sql, array( $user_id ) )->row();
		}
		
		function GetById( $id )
		{
			$sql = "SELECT * FROM accounts WHERE id = ?";
			
			return $this->query( $sql, array( $id ) )->row();
		}
		
		function IncrementPaymentExpirationOneYearByEmail( $email )
		{
			$sql = "UPDATE accounts SET payment_expiration = AddDate(payment_expiration, INTERVAL 1 YEAR)
				WHERE accounts.user_id = (SELECT id FROM users WHERE email = ?)";
				
			$this->db->query( $sql, array ( $email ) );
		}
		
		function IncrementPaymentExpirationOneYearById( $acct_id )
		{
			$sql = "UPDATE accounts SET payment_expiration = AddDate(payment_expiration, INTERVAL 1 YEAR)
				WHERE accounts.id = ?";
				
			$this->db->query( $sql, array ( $acct_id ) );
		}
		
		function SetPaymentExpirationById( $acct_id, $days_expiration )
		{
			$data = array(
							'payment_expiration' => $this->getMySQLDateTimePlusDays( $days_expiration )
						);
						
			$this->db->where('id', $acct_id);
			
			$this->db->update('accounts', $data);
		}
		
		function AddPaymentExpirationDaysById( $acct_id, $days_expiration )
		{
			$sql = "UPDATE accounts SET payment_expiration = AddDate(payment_expiration, INTERVAL ? DAY)
					WHERE accounts.id = ?";
					
			$this->db->query( $sql, array ( $days_expiration, $acct_id ) );
		}
		
		function IsAlmostExpired( $user_id )
		{
			$renew_reminder_threshold = config_item('renew_reminder_threshold');
			
			$sql = "SELECT Count(id) AS 'count'
					FROM accounts 
					WHERE DATE_SUB(payment_expiration, INTERVAL $renew_reminder_threshold DAY) < CURDATE()
					AND user_id = ?";
					
			return ($this->db->query( $sql, array( $user_id ) )->row()->count > 0 ? true : false );
		}		
		
		function GetAccountsToExpireInDays( $days )
		{
			$sql = "SELECT sites.site_name, sites.display_name, users.email, accounts.payment_expiration
					FROM accounts, users, sites
					WHERE
						users.id = accounts.user_id
					AND
						sites.user_id = users.id
					AND
						CAST( DATE_SUB(accounts.payment_expiration, INTERVAL $days DAY) AS DATE) = CURDATE()";
					
			return $this->db->query( $sql )->result();
		}
		
		function DeleteAccountsExpiredPastTolerance( $days_tolerance )
		{
			$sql = "DELETE FROM users WHERE
					users.id IN (SELECT accounts.user_id 
								 FROM accounts
								 WHERE
									DATE_SUB(CURDATE(), INTERVAL $days_tolerance DAY) > accounts.payment_expiration)";
									
			return $this->db->query( $sql );
		}
		
		function GetMostMostRecentAccountInfo( $limit )
		{
			$sql = "SELECT s.site_name, u.email, c.code, sp.username, a.starting_cost, a.created
					FROM accounts a, sites s, users u, coupons c, sales_persons sp 
					WHERE
						a.user_id = u.id
					AND
						s.user_id = u.id
					AND
						a.signup_coupon_code = c.code
					AND
						c.sales_person = sp.id
					ORDER BY a.created DESC
					LIMIT 0, ?";
			
			return $this->db->query( $sql, array ( $limit ) )->result();
		}
	}

?>