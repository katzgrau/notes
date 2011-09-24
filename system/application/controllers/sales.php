<?php 

	class Sales extends Controller
	{
		function Sales()
		{
			parent::Controller();
			
			$sales_id = $this->session->userdata('sales_id');
			
			if( ! $sales_id && $this->uri->segment(2) != 'login')
			{
				$this->load->helper('url');
				redirect('sales/login');
			}
		}
		
		function index()
		{
			$this->load->model('coupon');
			$this->load->model('account');
			$this->load->helper('string');
			$this->load->helper('utilities');
			
			$coupon_code 		= $this->input->post('coupon_code');
			$after_price 		= $this->input->post('after_price');
			$is_single_use 		= $this->input->post('is_single_use');
			$is_trial 			= $this->input->post('is_trial');
			$comment 			= $this->input->post('comment');
			$sales_person 		= $this->session->userdata('sales_id');
			$term_expiration 	= $this->input->post('days_expiration');
			$data['message']	= $this->session->flashdata('message');
					
			if( $coupon_code != '' && $after_price != '' && $term_expiration > 0 )
			{
				if( strlen( $coupon_code ) > 6 )
				{	
					$this->coupon->Create( 	$coupon_code, 
											$after_price, 
											$comment, 
											$is_single_use, 
											$is_trial, 
											$sales_person, 
											$term_expiration );
					
					$data['message'] = "A coupon with code $coupon_code has been created.";
				}
				else
				{
					$data['message'] 	= 'Coupon code must me longer than or equal to 6 characters.';
					$data['error'] 		= true;
				}
			}
			else
			{
				if( $after_price != '' ) $data['error'] = true;
			}
			
			$data['recent_signups']		= $this->account->GetMostMostRecentAccountInfo( 100 );
			$data['coupons'] 			= $this->coupon->GetBySalesPersonId( $sales_person );
			$data['random_hash'] 		= random_string('alnum', 10);
			$data['default_expiration'] = 365;
			$this->load->view('sales/sales', $data);
		}
		
		function login()
		{
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			
			$this->load->helper('url');
			
			if( $user )
			{
				$this->load->model('sales_person');
				$person = $this->sales_person->CheckAndRetrieveLogin( $user, $pass );
				
				if( $person )
				{
					$this->session->set_userdata( array (
															'username' => $user,
															'sales_id'	=> $person->id
														)
												);
												
					redirect('sales/');
					return;
				}
				else
				{
					$data['error'] = "Invalid username/password combo";
					$this->load->view('sales/login', $data);
				}
			}
			else
			{
				$this->load->view('sales/login', $data);
			}
		}
		
		function logout()
		{
			$this->session->sess_destroy();
			$this->load->helper('url');
			redirect('sales/login');
		}
		
		function deactivate_coupon( $coupon_code )
		{
			$this->load->model('coupon');
			$this->load->helper('url');
			
			$sales_id = $this->session->userdata('sales_id');
			
			$this->coupon->Deactivate( $sales_id, $coupon_code );
			
			redirect('sales/');
		}
				
		function reactivate_coupon( $coupon_code )
		{
			$this->load->model('coupon');
			$this->load->helper('url');
			
			$sales_id = $this->session->userdata('sales_id');
			
			$this->coupon->Reactivate( $sales_id, $coupon_code );
			
			redirect('sales/');
		}
		
		function change_password( )
		{
			$this->load->model('sales_person');
			$this->load->helper('url');
			
			$username 			= $this->session->userdata('username');
			$old_password 		= $this->input->post('old_password');
			$new_password 		= $this->input->post('new_password');
			$new_password_again = $this->input->post('new_password_again');
			
			if( $new_password != $new_password_again )
			{
				$this->session->set_flashdata('message', 'Your password was not changed. Your old password did not match your new password.');
				redirect('sales/');
			}

			$result = $this->sales_person->ChangePassword( $username, $old_password, $new_password );
			
			if( $result )
				$this->session->set_flashdata('message','Your password has been changed successfully.');
			else
				$this->session->set_flashdata('message','Your password was not changed. Check that you entered your old password correctly.');
			
			redirect('sales/');
		}
	}

?>