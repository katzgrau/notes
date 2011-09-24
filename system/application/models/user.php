<?php

	class User extends MY_Model
	{
		function GetUserCount()
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM users";
			
			return $this->db->query($sql)->row()->count;
		}
		
		function RegisterUser($group_id, $first_name, $last_name, $address, $city, $state, $country, $zip, $phone, $email, $fax)
		{
			$this->load->model('page');
			$this->load->model('site');
			
			$user_data = array (
					'group_id' => $group_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'address'	=> $address,
					'city'		=> $city,
					'state'		=> $state,
					'country'	=> $country,
					'zip'		=> $zip,
					'phone'		=> $phone,
					'email'		=> $email,
					'fax'		=> $fax,
					'created' => $this->getMySQLDateTime(),
					'modified' => $this->getMySQLDateTime()
				);
						
			$this->db->insert('users', $user_data);
			return  $this->db->insert_id();

		}
							
		function SaveUser($user_id, $first_name, $last_name, $address, $city, $state, $country, $zip, $phone, $email, $fax)
		{
			$data = array (
					'first_name' => $first_name,
					'last_name' => $last_name,
					'address'	=> $address,
					'city'		=> $city,
					'state'		=> $state,
					'country'	=> $country,
					'zip'		=> $zip,
					'phone'		=> $phone,
					'email'		=> $email,
					'fax'		=> $fax,
					'modified' => $this->getMySQLDateTime()
				);
			
			$this->db->where('id', $user_id);
			$this->db->update('users', $data);
		}
		
		function DeleteUserById( $user_id )
		{
			$sql = "DELETE FROM users WHERE id = ?";
			
			$this->db->query( $sql, array( $user_id ) );
			
			return true;
		}
		
		function DeleteUserBySiteName( $site_name )
		{
			$sql = "DELETE FROM users 
					WHERE users.id = (SELECT sites.user_id FROM sites WHERE sites.site_name = ?)";
			
			$this->db->query( $sql, array( $site_name ) );
			
			return true;			
		}
		
		function CheckLogin($site_name, $password)
		{
			$sql = "SELECT id FROM sites WHERE site_name = ? AND admin_password = ?";
			
			$result = $this->db->query( $sql, array( $site_name, $password ) );
			
			return (($result->num_rows() > 0) ? true : false);
		}
		
		function GetUserBySiteName( $site_name )
		{
			$sql = "SELECT users.* FROM users, sites
					WHERE users.id = sites.user_id
					AND sites.site_name = ?";
					
			$result = $this->db->query( $sql, array ( $site_name ) );
			
			return (($result->num_rows() > 0) ? $result->row() : null);
		}
		
		function GetUserBySiteId( $site_id )
		{
			$sql = "SELECT users.* FROM users, sites
					WHERE users.id = sites.user_id
					AND sites.id = ?";
					
			$result = $this->db->query( $sql, array( $site_id ) );
			
			return (($result->num_rows() > 0) ? $result->row() : null);
		}
		
		function GetFullUserList()
		{
			$sql = "SELECT sites.site_name, users.*
					FROM  users, sites
					WHERE sites.user_id = users.id
					ORDER BY users.last_name";
					
			return $this->db->query( $sql )->result();
		}
		
	}