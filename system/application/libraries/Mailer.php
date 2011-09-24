<?php

	class Mailer
	{
		var $CI;
		
		function Mailer()
		{
			$this->CI = &get_instance();
		}
		
		function SendEmail( $to, $subject, $message, $immediate = false)
		{	
			if( ! $immediate )
			{
				$this->EnqueueEmail( $to, $subject, $message );
				return true;
			}
			
			$this->CI->load->plugin('phpmailer');
			
			return send_email(	config_item('mail_host'), 
						config_item('mail_port'), 
						config_item('mail_protocol'), 
						config_item('mail_use_auth'), 
						config_item('mail_username'), 
						config_item('mail_password'), 
						$to,
						config_item('mail_from_address'),
						config_item('mail_from_name'),
						$subject, 
						$message);
		}
		
		function EnqueueEmail( $to, $subject, $message )
		{
			# To be implemented soon
			# Store the email in a new emails table in the db, send it later
			$this->CI->load->model('email');
			$this->CI->email->Create( $to, $subject, $message );
		}
		
		function SendEnqueuedEmails()
		{
			/* Get comfortable.. */
			set_time_limit ( 0 );
			
			$this->CI->load->model('email');
			
			$failures = array();
			
			$emails = $this->CI->email->GetEmails();
			
			foreach( $emails as $email )
			{
				$success = $this->SendEmail( $email->to, $email->subject, $email->message, true );
				
				if( ! $success ) $failures[] = $email->id;
			}
			
			$failed_count 	= sizeof( $failures );
			$sent_count 	= sizeof( $emails ) - $failed_count;
			
			/* Quicker to delete failures, right? */
			$this->CI->email->DeleteAllEmailsExcept( $failures );
			$this->CI->email->IncrementFailureCounts( $failures );
			
			return array( 'sent' => $sent_count, 'failed' => $failed_count );
		}
		
		function SendWelcomeEmail( $to, $site_name, $password, $immediate = false )
		{
			$data['site_name'] 	= $site_name;
			$data['password'] 	= $password;
			
			$subject = "Welcome to " . config_item('company_name');
			$message = $this->CI->load->view('email/welcome', $data, true );
			
			return $this->SendEmail( $to, $subject, $message, $immediate );
		}
		
		function SendPaymentReceivedEmail( $to, $site_name, $purchase_price, $expiration_date, $immediate = false )
		{
			$data['site_name'] 			= $site_name;
			$data['purchase_price'] 	= $purchase_price;
			$data['expiration_date'] 	= $expiration_date;
			
			$subject = "Your payment has been received!";
			$message = $this->CI->load->view('email/payment_received', $data, true );
			
			return $this->SendEmail( $to, $subject, $message, $immediate );
		}
		
		function SendExpirationEmail( $to, $site_name, $immediate = false )
		{
			$data['site_name'] 	= $site_name;
			
			$subject = "Your account is about to expire!";
			$message = $this->CI->load->view('email/expiration', $data, true );
			
			return $this->SendEmail( $to, $subject, $message, $immediate );
		}	
		
		function SendTrialExpirationEmail( $to, $site_name, $purchase_price, $immediate = false )
		{
			$data['site_name'] 	= $site_name;
			
			$subject = "How did you like your ". config_item('company_name') ." trial?";
			$message = $this->CI->load->view('email/payment_expiration', $data, true );
			
			return $this->SendEmail( $to, $subject, $message, $immediate );
		}
		
		function SendPasswordRecovery( $to, $site_name, $password, $immediate = false )
		{
			$data['site_name'] = $site_name;
			$data['password'] = $password;
			
			$message = $this->CI->load->view('email/forgot_password', $data, true );
			$subject = config_item('company_name') . " Password Recovery";
			
			return $this->SendEmail( $to, $subject, $message );
		}
		
		function SendSupportRequest( $site_name , $subject, $message )
		{
			$this->CI->load->helper('typography');
			$this->CI->load->model('user');
			
			$message = auto_typography( $message );
			
			$user = $this->CI->user->GetUserBySiteName( $site_name );
			
			/* Send support email to user */
			$data = array(
						'subject' => $subject,
						'message' => $message
					);
			
			$msg = $this->CI->load->view('email/support-received', $data, true);
			
			$this->SendEmail( $user->email, config_item('company_name') . " Support Message Received", $msg );
			
			/* Send support email to sys admins */
			$data = array(
						'subject' => $subject,
						'message' => $message,
						'site_name' => $site_name,
						'email'	=> $user->email
					);	
			
			$msg = $this->CI->load->view('email/support-request', $data, true);
			
			$this->SendSystemNotification( config_item('company_name') . " Support Request ($site_name)", $msg );
		}
		
		function SendSystemError( $is_severe, $subject, $message )
		{
			$this->SendSystemNotification( ( $is_severe ? "Severe " : "" ) . "Error: " . config_item('company_name') . " $subject", 
											$message );
		}
		
		function SendSystemNotification( $subject, $message )
		{
			set_time_limit ( 0 );
			
			$recips = config_item('system_notification_email_recipients');
			
			foreach( $recips as $recip )
			{
				$this->SendEmail( $recip, $subject, $message );
			}
		}
	}

?>