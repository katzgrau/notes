<?php

	class Sess extends MY_Model
	{
		function GetSessionCount()
		{
			if( config_item('sess_use_database') )
			{
				$sql = "SELECT COUNT(*) AS 'count' FROM " . config_item('sess_table_name');
				return $this->db->query($sql)->row()->count;
			}
			else
			{
				return 0;
			}
		}
		
		function GetLastAccess()
		{
			$this->load->helper('date');
			
			$sql = "SELECT MAX(last_activity) AS 'max' FROM ". config_item('sess_table_name') ." 
					WHERE session_id <> ?";
					
			$result = $this->db->query($sql, array( $this->session->userdata('session_id') ));
			
			if( $result->num_rows() == 0) return "No Record";
			
			return unix_to_human( $result->row()->max );
		}
		
	}

?>