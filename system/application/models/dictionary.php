<?php 

	/* Copyright joe plumber <plumber@gmail.com> 2009 */
	
	class Dictionary extends MY_Model
	{
		private function CreateEntry($name, $value)
		{
			$this->DeleteEntry( $name );
			
			$data = array(
							'name' => $name,
							'value' => $value,
							'created' => $this->getMySQLDateTime(),
							'modified' => $this->getMySQLDateTime()
						);
						
			$this->db->insert('dictionary', $data );
		}
		
		private function UpdateEntry( $name, $value )
		{
			$data = array ( 'name' => $name,
							'value' => $value,
							'modified' => $this->getMySQLDateTime() );
							
			$this->db->update( 'dictionary', $data );
		}
		
		function Set( $name, $value )
		{
			$entry = $this->Get( $name );
			
			if( $entry )
				$this->UpdateEntry( $name, $value );
			else
				$this->CreateEntry( $name, $value );
		}
		
		function Get($name, $default = null)
		{
			$sql = "SELECT * FROM dictionary WHERE name = ?";
			
			$result = $this->db->query( $sql, array ( $name ) );
			
			if( $result->num_rows() == 0 ) 
				return $default;
			else
				return $result->row()->value;
		}
		
		function GetByMinutesOld($name, $minutes_old)
		{
			$sql = "SELECT * FROM dictionary 
					WHERE name = ?
					AND DATE_ADD(modified, INTERVAL $minutes_old MINUTE) > NOW()";
			
			return $this->db->query( $sql, array ( $name, $minutes_old ) )->row()->value;
		}

		private function DeleteEntry( $name )
		{
			$sql = "DELETE FROM dictionary WHERE name = ?";
			
			$this->db->query( $sql, array ( $name ) );
		}
	}

?>