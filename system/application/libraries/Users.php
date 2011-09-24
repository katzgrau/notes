<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 *	This class a largely a utility that ties together many of the functions that are required for users, but require extensive business logic
*	use of models, and fairly frequent reuse. For example, when creating a user, we want to set up his account, website, first webpage,
*	and send him a welcome email too. This class is one-stop shoppong for that kind of stuff.
 */
class Users {
	
   /**
	*	For complete user setup -- creates an account, website, user, and default page.
	*	site_info is an associative array containing the site_name and admin password
	*	user_info is also an associative array, containing attributes about the user_error
	*	account_info is.. guess what? An associative array containing basic account information
	*/
   function CreateFullAccount( $site_info, $user_info, $account_info )
   {
		$CI = &get_instance();
		
		$CI->load->model('user');
		$CI->load->model('account');
		$CI->load->model('site');
		$CI->load->model('page');
		$CI->load->helper('utilities');
		
		$CI->db->trans_start();		

		/* Register the user first */
		$user_id = $CI->user->RegisterUser( config_item('default_group_id'), 
											$user_info['first_name'], 
											$user_info['last_name'], 
											$user_info['address'], 
											$user_info['city'], 
											$user_info['state'], 
											$user_info['country'], 
											$user_info['zip'], 
											$user_info['phone'], 
											$user_info['email'], 
											$user_info['fax']);
		/* Crate the site next */
		$site_id = $CI->site->Create( $user_id, $site_info['site_name'], $site_info['admin_password'] );
		
		/* If this installation is a public one -- where individuals pay for accounts, like a public service, then we need to set up accounts for billing. */
		if( config_item('individual_accounts_enabled') && $account_info )
		{
			$CI->account->Create( $account_info['account_type_id'], 
								  config_item('default_group_id'), 
								  $user_id, 
								  $account_info['signup_coupon_code'], 
								  $account_info['starting_cost'], 
								  $account_info['discount'], 
								  $account_info['payment_expiration'], 
								  $account_info['comments'] );
		}
		
		/* Create a default page based off a value in the config. This should really be changed to using a view */
		$CI->page->Create($site_id, 
						 config_item('default_page_title'), 
						 config_item('default_page_content'), 
						 true, 
						 false);
		
		/* End the transaction status. Hopefully that all worked. Well, why wouldn't it? */
		$CI->db->trans_complete();
		
		return $CI->db->trans_status();
    }
	
	/* This is a shortcut method that uses CreateFullAccount, but fills in a lot of information for you. */
	function CreateBasicAccount( $site_name, $admin_password, $email, $account_info = array(), $user_info = array() )
	{
		$CI = &get_instance();
		
		$site_info = array ( 'site_name' => $site_name, 'admin_password' => $admin_password );
		$user_info['email'] = $email;
		
		/* Let the user know via email */
		$CI->load->library('mailer');
		$CI->mailer->SendWelcomeEmail( $email, $site_name, $admin_password );
		
		return $this->CreateFullAccount( $site_info, $user_info, $account_info );
	}
	
	/**
	*	Grabs a user from the accounts_pending section, and creates an account based off the saved information
	*	term_expiration is the number of days that the account will expire in
	*/
	function CreateFromPending($site_name, $term_expiration = 365 )
	{
		$CI = &get_instance();
		
		$CI->load->model('account_pending');
		
		$acct = $CI->account_pending->GetBySiteName( $site_name );
		
		if( ! $acct ) 
		{
			/* Bad news... */
			return false;
		}
		
		if( config_item('individual_accounts_enabled') )
		{
			$account_info = array(  
								'account_type_id' 		=> ($acct->is_trial ? config_item('trial_account_type_id') : config_item('individual_account_type_id') ),
								'signup_coupon_code' 	=> $acct->coupon_code,
								'starting_cost' 		=> $acct->purchase_price,
								'payment_expiration' 	=> $CI->account_pending->getMySQLDateTimePlusDays( $term_expiration ),
								'comments' 				=> ''
							);
							
			/* Congratulate the user for paying us */
			$CI->load->library('mailer');
			$CI->mailer->SendPaymentReceivedEmail( $acct->email, $acct->site_name, $acct->purchase_price, $account_info['payment_expiration'] );
			
			$result = $this->CreateBasicAccount( $acct->site_name, $acct->admin_password, $acct->email, $account_info );
		}
		else
		{
			$result = $this->CreateBasicAccount( $acct->site_name, $acct->admin_password, $acct->email );
		}
		
		$CI->account_pending->DeleteBySiteName( $site_name );
		
		return $result;
	}
	
	/**
	 *	Grabs a user from the list of pending renewals, and adds a given number of days to his account expiration
	 */
	function RenewFromPending( $account_id, $days_expiration = 365 )
	{
		$CI = &get_instance();
		
		$CI->load->model('account');
		$CI->load->model('renew_pending');
		
		$CI->account->AddPaymentExpirationDaysById( $account_id, $days_expiration );
		
		$CI->renew_pending->DeleteByAccountId( $account_id );
	}
	
	/* An alias for user->DeleteUserbySiteName(). Relies on database cascades to take care of everything else. */
	function DeleteUserBySiteName( $site_name )
	{
		$CI = &get_instance();
		
		$CI->load->model('user');
		
		// Delete all of their files!
		
		return $this->user->DeleteUserBySiteName( $site_name );
	}
}

?>