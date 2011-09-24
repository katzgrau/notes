<?php

	class Install extends Controller
	{
		function Install()
		{
			parent::Controller();
		}
		
		function index()
		{
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ( $username )
			{
				if( $username == config_item('admin_username') &&
				    $password == config_item('admin_password') )
				{
					$sql = file_get_contents( config_item( 'data_model_import_filename' ) );
					
					$lines = split( ';' , $sql );

					foreach( $lines as $line )
					{
						#echo "$count :: $line"; $count++;
						if( strlen( trim( $line ) ) > 0 ) $this->db->query( $line );
					}
					
					$this->load->view('install/success');
				}
				else
				{
					$data['message'] = 'Incorrect Login.';
					$this->load->view('install/login', $data);
				}
			}
			else
			{
				$this->load->view('install/login');
			}
		}
		
		function success()
		{
			echo "DB Installation Complete.";
		}
	}
	
?>