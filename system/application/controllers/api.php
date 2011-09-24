<?php
	class Api extends Controller
	{	
		
		function Api()
		{
			parent::Controller();
		}
		
		function index()
		{
			$this->kill_php_timeout();	
		}
		
		function rss( $siteName )
		{
			if (!$siteName) return;
			
			$this->load->model('site');
			$this->load->model('page');
			$this->load->model('file');
			$this->load->model('user');

			$site = $this->site->GetSite( $siteName );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( !$site ) { show_404('error_404'); exit; }
			
			$sitePageMeta = $this->page->GetPages( $siteName );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( sizeof( $sitePageMeta ) <= 0 ) { show_404('error_404'); exit; }
			
			$pageContent = $this->page->GetPage( $siteName, $pageSlug );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( !$pageContent ) { show_404('error_404'); exit; }
			
			$links = $this->site->GetLinks( $siteName );
			
			$files = $this->file->GetSiteUploads( $siteName, $pageContent->page_slug );
			
			#print_r( $files ); return;
			
			$user = $this->user->GetUserBySiteName($siteName);
			
			$data['user'] 			= $user;
			$data['site'] 			= $site;
			$data['site_name'] 		= $siteName;
			$data['sitePageMeta'] 	= $sitePageMeta;
			$data['pageContent'] 	= $pageContent;
			$data['links'] 			= $links;
			$data['files'] 			= $files;
			
			@header("Content-Type: text/xml"); 
			$this->load->view("themes/rss", $data);
		}

		function send_emails()
		{
			if( ! $this->is_admin() ) return;

			echo "Authentication accepted.\n";
			
			/* This might take a while */
			$this->kill_php_timeout();	
			
			$this->load->library('mailer');
			$result = $this->mailer->SendEnqueuedEmails();
			
			/* Code */
			echo "Sent queued emails. Result: Sent={$result['sent']} ; Failed={$result['failed']} \n";
			echo "Task complete.\n";
		}
		
		function process_uploads()
		{
			if( ! $this->is_admin() ) return;
			echo "Authentication accepted.\n";
			
			/* This might take a while */
			$this->kill_php_timeout();

			$this->load->library('uploads');
			$result = $this->uploads->ProcessUploads();
			
			echo "Processed Uploads. Result: Successes={$result['successes']} ; Failed={$result['failures']} \n";
			echo "Task complete.\n";
		}
		
		
		
		/* Send emails to users whose accounts will expire in the posted 'days' variable. */
		function send_account_expiration_emails()
		{
			if( ! $this->is_admin() ) return;
			
			echo "Authentication accepted.\n";

			/* This might take a while */
			$this->kill_php_timeout();	
			
			$days_until_expiration = $this->input->post('days');
			
			$this->load->model('account');
			$this->load->library('mailer');
			
			$accounts = $this->account->GetAccountsToExpireInDays( $days_until_expiration );
			
			/* Send each user an email */
			foreach( $accounts as $account )
			{
				$this->mailer->SendExpirationEmail( $account->email, $account->site_name );
				echo "Sent to: {$account->site_name} - {$account->email} \n";
			}
			
			echo "Task complete.\n";
		}
		
		/* Clear accounts which have not been converted past a given number of days set in the config */
		function clear_expired_accounts()
		{
			if( ! $this->is_admin() ) return;
			
			echo "Authentication accepted.\n";
			
			$this->load->model('account');
			
			$this->account->DeleteAccountsExpiredPastTolerance( config_item('account_expiration_tolerance_days') );
			
			echo "Task complete.\n";
		}
		
		/* Clear accounts which are pending, but haven't been paid for in a configurable amount of time */
		function clear_unpaid_pending_accounts(  )
		{
			if( ! $this->is_admin() ) return;

			echo "Authentication accepted.\n";
			
			$hours_tolerance = config_item('pending_account_expiration_tolerance_hours');
			
			$this->load->model('account_pending');
			
			$this->account_pending->DeleteAllCreatedHoursAgo( $hours_tolerance );
			
			echo "Task complete.\n";
		}
		
		function add_user()
		{
			if( ! $this->is_admin() ) return;
			
			$site_name 		= $this->input->post('site_name');
			$admin_password = $this->input->post('password');
			$email			= $this->input->post('email');
			$first_name		= $this->input->post('first_name');
			$last_name		= $this->input->post('last_name');
			
			if( $site_name && $email && $admin_password )
			{
				$this->load->library('users');
				
				$user_info = array( 'first_name' => $first_name, 'last_name' => $last_name );
				$acct_info = array();
				
				$result = $this->users->CreateBasicAccount( $site_name, $admin_password, $email, $acct_info, $user_info );
			}
			else
			{
				$result = false;
			}
			
			echo ( $result ? "1" : "0" );
		}
		
		function delete_user()
		{
			if( ! $this->is_admin() ) return;
			
			$site_name = $this->input->post('site_name');
			
			if (! $site_name ) { echo "0"; return; }
			
			$this->load->model('user');
			$this->user->DeleteUserBySiteName( $site_name );
			
			return "1";
		}
		
		function get_user_list()
		{
			if( ! $this->is_admin() ) return;
			
			$this->load->model('user');
			$users = $this->user->GetFullUserList();

			for($i = 0; $i < sizeof( $users ); $i++)
			{
				echo "{$users[$i]->site_name}, {$users[$i]->email}";
				if( $i < sizeof( $users ) - 1 ) echo "\n";
			}
		}
		
		function send_usage_report()
		{
			if( ! $this->is_admin() ) return;
			
			$subject = config_item('company_name') . " usage report for " . date('l jS \of F Y');
			
			$this->load->library('mailer');
			$this->load->model('user');
			$this->load->model('file');
			$this->load->model('page');
			$this->load->model('coupon');
			$this->load->model('account');
			
			$data['number_of_users'] 	= $this->user->GetUserCount();
			$data['disk_usage_kb'] 		= $this->file->GetFileDiskUsage();
			$data['accounts']			= $this->account->GetMostMostRecentAccountInfo( 10 );
			$data['coupons']			= $this->coupon->GetTopCouponInfo( 5 );
			$data['page_count'] 		= $this->page->GetPageCount();
			
			$content = $this->load->view('reports/summary', $data, true);

			$recips = config_item('system_notification_email_recipients');
			
			foreach( $recips as $recip )
				$this->mailer->SendEmail( $recip, $subject, $content );
		}
		
		/* Return true/false based on whether the user is an administrator */
		private function is_admin()
		{
			$admin_password = $this->input->post('admin_password');
			
			if( $admin_password == config_item('admin_password') )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		/* Kill the PHP timeout for long-running scripts */
		private function kill_php_timeout()
		{
			set_time_limit ( 0 );
		}
		
		/* This should be coming from paypal, or our default payment processor. Only they should be accessing this method. */
		function ipn()
		{
			$this->load->model('payment_notification');
			$this->load->model('coupon');
			$this->load->helper( config_item('payment_helper') );
			
			/* Get the IPN sent to us, and verify it */
			$response = verify_and_retrieve_payment();
			
			/* 
			 * $response will be a 2d array. $response[0] contains true/false based on whether the ipn is 
			 *  verified that it came from paypal 
			 *  $response[1] contains all the POSTED transaction properties that PayPal sent us
			 */
			
			$payload 		= $response[1];			
			$payer_email 	= $payload['payer_email'];			
			$purchase_price = (float)(trim($payload['payment_gross']));
			$type 			= trim($payload['txn_type']);
			$payer_email	= trim($payload['payer_email']);			
			$info 			= &info_from_item_number( $payload['item_number'] );
			$purchased_item = $info['type'];
			$site_name 		= $info['site_name'];
			
			/* Log it in the database in case anything screwy happens */
			$this->payment_notification->Create($site_name, 
												$account_id, 
												$purchase_price, 
												print_r( $response[1], true ), 
												$response[0], 
												$this->session->userdata('ip_address'));
			
			/* A bogus notification! Good thing it's logged! */
			if( $response[0] == false && !config_item('testing_mode') ) return;
			
			#print_r ( $info );			
			#echo "Site Name: $site_name; Price_paid: $purchase_price; Txn Type: $type; Email: $payer_email; Purchase Type: $purchased_item;";
			
			$this->load->library('users');
			
			/* Process the transaction */
			if( $type == 'web-accept' || $type == 'web_accept')
			{
				if( $purchased_item == "new" )
				{
					$this->load->model('account_pending');
					
					$acct = $this->account_pending->GetBySiteName( $site_name );
					
					if( (float)($acct->purchase_price) != (float)$purchase_price )
					{
						echo "PRICE MISMATCH."; return;
					}
					
					if( $acct->coupon_code )
					{
						$coupon = $this->coupon->GetByCode( $acct->coupon_code );
						if( $coupon ) $ret = $this->users->CreateFromPending( $site_name, $coupon->term_expiration );
					}
					
					if( !$coupon ) $ret = $this->users->CreateFromPending( $site_name );
		
				}
				elseif ( $purchased_item == "renew" )
				{
					$acct_id = $info['account_id'];
					$this->load->model('renew_pending');
					
					$acct = $this->renew_pending->GetByAccountId( $acct_id );
					
					if( (float)($acct->purchase_price) != (float)$purchase_price )
					{
						echo "PRICE MISMATCH. {$acct->purchase_price} != $purchase_price"; return;
					}
					
					/* Make the account expire when coupon says */
					if( $acct->coupon_code )
					{
						$coupon = $this->coupon->GetByCode( $acct->coupon_code );
						if( $coupon ) $this->users->RenewFromPending( $acct_id, $coupon->term_expiration );
					}
					
					if( !$coupon ) $this->users->RenewFromPending( $acct_id );
					
					// Maybe send an email notice?
				}
				else
				{
					// Huh? We don't have any other things you can order!
				}
			}
			else
			{
				// Huh? We don't accept payments that way!
			}
		}
		
	}

?>