<?php 

class Plugin_tools
{
	private $CI;
	
	function Plugin_tools()
	{
		$this->CI = &get_instance();
	}
	
	function &Database_Query( $query )
	{
		return $this->CI->db->query( $query )->result();
	}
	
	function Database_DoesTableExist( $table_name ) 
	{
		return $this->CI->db->table_exists();
	}
	
	function Dictionary_Get( $key_name, $default = null ) 
	{
		$this->CI->load->model('dictionary');
		return $this->CI->dictionary->Get( $key_name, $default );
	}
	
	function Dictionary_Set( $key_name, $value ) 
	{
		$this->CI->load->model('dictionary');
		return $this->CI->dictionary->Set( $key_name, $value );
	}
	
	function Input_Get( $key_name ) 
	{
		return $this->CI->input->get( $key_name );
	}
	
	function Input_Post( $key_name ) 
	{
		return $this->CI->input->post( $key_name );
	}
	
	function Preference_Get( $user_id, $preference_name, $default = null ) 
	{
		$this->CI->load->model('preference');
		return $this->CI->preference->Get( $user_id, $preference_name, $default );
	}
	
	function Preference_Set( $user_id, $preference_name, $value ) 
	{
		$this->CI->load->model('preference');
		return $this->CI->preference->Get( $user_id, $preference_name, $value );
	}
	
	function Session_GetUserId() 
	{
		if( $this->Session_IsLoggedIn() )
			return $this->CI->session->userdata('user_id');
		else
			return false;
	}
	
	function Session_GetSiteId() 
	{
		if( $this->Session_IsLoggedIn() )
			return $this->CI->session->userdata('site_id');
		else
			return false;
	}
	
	function Session_GetSiteName() 
	{
		if( $this->Session_IsLoggedIn() )
			return $this->CI->session->userdata('site_name');
		else
			return false;
	}
	
	function Session_GetData( $key_name ) 
	{
		return $this->CI->session->userdata( $key_name );
	}
	
	function Session_SetData( $key_name, $value )
	{
		$this->CI->session->set_userdata( $key_name, $value );
	}
	
	function Session_Destroy() 
	{
		$this->CI->session->sess_destroy();
	}
	
	function Session_IsLoggedIn()
	{
		if( ! $this->CI->session->userdata('user_id') ) 
			return false;
		else
			return true;
	}
	
	function URL_GetSegment($n, $default = false)
	{
		return $this->CI->uri->segment( $n , $default );
	}
	
	function URL_GetBase()
	{
		return config_item('base_url');
	}
}

?>