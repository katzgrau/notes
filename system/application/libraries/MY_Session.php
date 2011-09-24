<?php

class MY_Session extends CI_Session {

    function MY_Session()
    {
        parent::CI_Session();
    }
	
	function get_data_by_session_id($session_id) 
	{
		$this->CI->db->where('session_id', $session_id);
		log_message('debug', "IN FUNCTION. SID: $session_id");
		$query = $this->CI->db->get($this->sess_table_name);
		
		if ($query->num_rows() == 0)
		{
			$this->sess_destroy();
			return FALSE;
		}

		// Is there custom data?  If so, add it to the main session array
		$row = $query->row();
		
		if (isset($row->user_data) AND $row->user_data != '')
		{
			$custom_data = $this->_unserialize($row->user_data);

			if (is_array($custom_data))
			{
				foreach ($custom_data as $key => $val)
				{
					$session[$key] = $val;
				}
			}
		}

		return $session;
	}
	
	function get_session_id()
	{
		
	}
}

?>