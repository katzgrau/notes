<?php

	class Admin extends Controller
	{
		function Admin()
		{
			parent::Controller();
			
			$this->load->helper('url');
			
			// Make sure that this user is an admin. If not, redirct to the login page
			if( $this->uri->segment(2) != "login" )
			{
				if( ! $this->session->userdata('is_admin') )
				{
					redirect('admin/login');
				}
			} 
		}
		
		function index( $data = array() )
		{
			$this->load->model('site');
			$this->load->model('page');
			$this->load->model('user');
			$this->load->model('file');
			$this->load->model('sess');
			
			// Gather up statistics for the admin page
			$data['site_count'] = $this->site->GetSiteCount();
			$data['user_count'] = $this->user->GetUserCount();
			$data['page_count'] = $this->page->GetPageCount();
			
			$data['session_count'] = $this->sess->GetSessionCount();
			$data['last_activity'] = $this->sess->GetLastAccess();
			
			$data['upload_disk_usage'] =  round($this->file->GetFileDiskUsage() / 1000, 2);
			$data['upload_file_count'] = $this->file->GetFileCount();
			$data['top_disk_usage_sites'] = $this->file->GetTopSiteFileUsage();
		
			$this->load->view('admin/admin', $data);
		}
		
		function login()
		{
			$this->load->helper('url');
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($username)
			{
				/* The password is stored in the config, not the database */
				if( $username == config_item('admin_username') &&
					$password == config_item('admin_password') )
				{
					$this->session->set_userdata(array( 'is_admin' => true ));
					redirect('admin');
				}
				
				$data['message'] = "Bad username/password combination ..";
			}
			
			$this->load->view('admin/login', $data);
		}
		
		function logout()
		{
			$this->load->helper('url');
			$this->session->sess_destroy();
			
			redirect('admin/login');
		}
		
		function delete_user()
		{
			$site_id = $this->input->post('user_id');
		}
		
		function delete_site()
		{
			$site_name = $this->input->post('site_name');
			
			if( $site_name )
			{
				$this->load->model('site');
				$site_id = $this->site->GetIdFromSiteName($site_name);
				
				if( $site_id )
				{
					$data['notification'] = "Site '$site_name' (#$site_id) has been removed.";
				}
				else
				{
					$data['notification'] = "Site '$site_name' could not be found.";
				}
			}
			
			$this->index($data);
		}
		
		
	}

?>