<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
		
		$this->load->helper('url');
		
		
		if( ! config_item('individual_accounts_enabled') && 
				$this->uri->segment(2) != 'search' &&
				$this->uri->segment(2) != 'login' &&
				$this->uri->segment(2) != 'logout' &&
				$this->uri->segment(2) != 'forgot_password')
		{
			redirect('home/search');
		}
	}
	
	function search()
	{
		if( ! config_item('individual_accounts_enabled') )
		{
			$keyword = $this->input->post('search');
			
			if( $keyword )
			{
				$this->load->model('site');
				$data['keyword'] = $keyword;
				$data['search_results'] = $this->site->Search( $keyword );	
			}
			else
			{
				$this->load->model('user');
				$data['users'] = $this->user->GetFullUserList();
			}
			
			$this->load->view('home/search', $data);
		}
	}
	
	function index()
	{
		$this->load->view('home/home');
	}

		
		function pricing()
		{
			$data['page'] = "pricing";
			$this->load->view('home/pricing', $data);
		}
		
		function trial()
		{
			$data['page'] = "trial";
			$this->load->view('home/trial', $data);
		}
		
		function features()
		{
			$data['page'] = "features";
			$this->load->view('home/features', $data);
		}	
		
		function how_it_works()
		{
			$data['page'] = "how_it_works";
			$data['include_modal'] = true;
			$this->load->view('home/how_it_works', $data);
		}		
		
		function support()
		{
			$data['page'] = "support";
			$this->load->view('home/support', $support);
		}
		
		function register()
		{
			$data['page'] = "register";
			$this->load->view('home/register', $data);
		}
		
		function renew()
		{
			$user_id = $this->session->userdata('user_id');
			
			if( !$user_id )
			{
				$this->load->helper('url');
				
				$this->session->set_flashdata('next', 'home/renew');
				redirect('home/login');
			}
			
			$this->load->view('home/renew');
		}
		
		function login()
		{
			$this->load->helper('url');
			
			$site_name = $this->input->post('site_name');
			$password = $this->input->post('password');
			
			$this->session->keep_flashdata('next');
			
			if( $site_name )
			{
				if( $this->isLoggedIn($site_name, $password) )
				{
					/* If the user was doing something previously */
					$next = $this->session->flashdata('next');
					if( $next ) redirect( $next );
					
					/* Check for account expiration! */
					if( config_item('individual_accounts_enabled') )
					{
						$this->load->model('account');
						$user_id = $this->session->userdata('user_id');
						/* Do they need to renew their subscription? */
						if( $this->account->IsAlmostExpired( $user_id ) )
						{
							redirect('home/renew');
						}
					}
					
					redirect( "author/" );
				}
				else
				{
					$data['status'] = "The username and password combination you entered did not exist.";
				}
			}
			
			$data['page'] = 'login';
			$this->load->view('home/login', $data);
		}
		
		function paid()
		{
			$this->load->view('home/paid');
		}
		
		function logout()
		{
			$this->load->helper('url');
			$this->session->sess_destroy();
			redirect('home/login');
		}
		
		function forgot_password()
		{
			$site_name = $this->input->post('site_name');
			
			if( ! $site_name )
			{
				$this->load->view('home/forgot_password');
			}
			else
			{
				$this->load->model('user');
				$this->load->model('site');
				$this->load->library('mailer');
				
				$user = $this->user->GetUserBySiteName( $site_name );
				
				if( ! $user )
				{
					$data['status'] = "The site name you entered was not valid. Please try again.";
					$this->load->view( 'home/forgot_password', $data );
					return;
				}
				
				$site = $this->site->GetSite( $site_name );
				
				$this->mailer->SendPasswordRecovery( $user->email, $site_name, $site->admin_password );
				
				$this->load->view('home/sent_forgotten_password');
			}
		}
		
		/* Not visible to the outside */
		private function isLoggedIn($site_name, $password)
		{
			$this->load->model('user');
			$this->load->model('site');
			$this->load->helper('url');
			
			$isValid = $this->user->CheckLogin($site_name, $password);
			
			if( $isValid )
			{
				/* If the combo is valid, send them to an appropriate URL */
				$site = $this->site->GetSite( $site_name );
				$user = $this->user->GetUserBySiteName( $site_name );
				
				/* Set session data */
				$this->session->set_userdata(array('display_name' => $site->display_name));
				$this->session->set_userdata(array('site_name' => $site->site_name));
				$this->session->set_userdata(array('site_id' => $site->id));
				$this->session->set_userdata(array('user_id' => $user->id));
				$this->session->set_userdata(array('user_first_name' => $user->first_name));
				
				return true;
			}
			else
			{
				return false;
			}
		}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */