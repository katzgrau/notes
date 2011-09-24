<?php
	class Preference extends MY_Model
	{
		function Get( $user_id, $name, $default )
		{
			$sql = "SELECT name, value FROM preferences WHERE name = ? AND user_id = ?";
			
			$result = $this->db->query( $sql, array( $name, $user_id ) );
			
			if( $result->num_rows() > 0 ) 
				return $result->row()->value;
			else
				return $default;
		}

		function GetRow( $user_id, $name )
		{
			$sql = "SELECT name, value FROM preferences WHERE name = ? AND user_id = ?";
			
			return $this->db->query( $sql, array( $name, $user_id ) )->row();
		}		
		
		function Set( $user_id, $name, $value )
		{
			$check = $this->GetRow( $user_id, $name );
			
			if( ! $check )
				$this->Create( $user_id, $name, $value );
			else
				$this->Update( $user_id, $name, $value );
		}
		
		private function Create( $user_id, $name, $value )
		{
			$data = array ( 'user_id' => $user_id,
							'name' => $name,
							'value' => $value,
							'created' => $this->getMySQLDateTime(),
							'modified' => $this->getMySQLDateTime() );
			
			
			$this->db->insert( 'preferences' , $data );
		}
		
		private function Update($user_id, $name, $value )
		{
			$data = array ( 'value' => $value,
							'modified' => $this->getMySQLDateTime() );
							
			$this->db->where( 'user_id', $user_id );
			$this->db->where( 'name', $name );
			$this->db->update( 'preferences', $data );
		}
	}
?>