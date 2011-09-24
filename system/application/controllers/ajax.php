<?php

	class Ajax extends Controller
	{
		function Ajax()
		{
			parent::Controller();
			// Check the config to see if we should print stats on sql / page loading times
		}
		
		function index()
		{
			
		}
		
		/**
		*	This call will check to see if the posted site_name exists in the data base.
		*	It will primarily be used by ajax calls. It will return 1 for true, or 0 for false
		*/
		function does_sitename_exist()
		{
			$this->load->model('site');
			
			$site_name = $this->input->post('site_name');
			
			echo ( $this->site->DoesSiteExist( $site_name ) ? '1' : '0' );
		}
		
		/**
		*	This function expects a querystring-like argument via post (page_list)
		*	which corresponds to the ordering of pages on the website, set via the author/settings page.
		*	It will set the appropriate settings in the database.
		*/
		function savePageOrder()
		{
			/* User isn't logged in? Hose him */
			$site_id = $this->session->userdata('site_id');
			if( !$site_id ) return;
			
			$this->load->model('site');
			
			$list = array();
			parse_str( $this->input->post('page_list'), $list );
			$list = $list['page_list'];
			
			for($i = 0; $i < sizeof($list); $i++)
			{
				$this->site->SetPageListPriority( $site_id , $list[$i], $i);
			}
		}

		/**
		 *	This, like savePageOrder, will save the users links to display in a specific order
		 *	It also accepts a query-string like argument
		 */
		function saveLinkOrder()
		{
			/* User isn't logged in? Hose him */
			$site_id = $this->session->userdata('site_id');
			if( !$site_id ) return;
			
			$this->load->model('site');
			
			$list = array();
			parse_str( $this->input->post('link_list'), $list );
			$list = $list['link_list'];
			
			for($i = 0; $i < sizeof($list); $i++)
			{
				$this->site->SetLinkListPriority( $site_id , $list[$i], $i);
			}
		}
		
		/**
		*	This will add the POSTed link to the user's site
		*/
		function add_link()
		{
			$site_id = $this->session->userdata('site_id');
			if( !$site_id ) return;
			
			$this->load->model('site');
			$this->load->helper('url');
			
			$title = $this->input->post('linkTitle');
			$url = $this->input->post('linkUrl');
			
			if( $this->site->GetLinkCount( $site_id ) < config_item('max_user_links') )
			{
				if( $title && $url ) $id = $this->site->AddLink( $site_id, $title, prep_url($url) );
				echo $id;
			}
			else
			{
				echo "0";
			}
		}
		
		/**
		*	Primarily used during registration, this call is to check that a given sitename is both
		*	not already registered, or waiting to be registered.
		*/
		function is_new_sitename_valid( )
		{
			$this->load->model('site');
			$this->load->model('account_pending');
			$this->load->helper('utilities');
			
			$site_name = $this->input->post('site_name');

			if( ! is_valid_sitename( $site_name ) )
			{
				echo "-1"; return;
			}
			
			if ($this->site->DoesSiteExist($site_name) ||
				   $this->account_pending->DoesPendingSiteExist($site_name)) 
			{
				echo "-2"; return;
			}
			
			echo "1";
		}
		
		/**
		*	This function accepts a link_id, and will remove the given link
		*	from a user's website.
		*/
		function remove_link()
		{
			$site_id = $this->session->userdata('site_id');
			if( !$site_id ) return;
			
			$this->load->model('site');
			
			$link_id = $this->input->post('link_id');
			
			if( $link_id ) $id = $this->site->RemoveLink( $site_id, $link_id );
		}
		
		/**
		*	This function retrieves a page of themes for the user to select in the settings page
		*	Used with ajax calls only.
		*/
		function get_theme_view( $page = false )
		{
                        $user_id = $this->session->userdata('user_id');
			$this->load->model('theme');
			
			if( ! $page ) $page = $this->input->post('page');
			if( ! $page ) $page = 1;
			
			$themes = $this->theme->GetThemesByPage($page, config_item('theme_viewer_themes_per_page'), $user_id);

			$data['themes'] = $themes;

			if ( $page * config_item('theme_viewer_themes_per_page') >= $this->theme->GetThemeCount($user_id) )
				$data['is_last_page'] = true;
			else
				$data['is_last_page'] = false;
			
			if ( $page == 1 ) 
				$data['is_first_page'] = true;
			else
				$data['is_first_page'] = false;
			
			$this->load->view('author/ajax/theme_view', $data);
		}
		
		/**
		*	This page will get a preview page of a given theme.
		*/
		function get_theme_preview( $theme_id )
		{
			$this->load->model('theme');
			
			$data['site_name'] 		= $this->session->userdata('site_name');
			$data['theme'] 			= $this->theme->GetThemeById( $theme_id );
			
			$this->load->view('author/ajax/theme_preview', $data);
		}
		
		/**
		 *	This is a reusable method that walks the user through renewing their account
		 *	It is considered an ajax function because it is:
		 *		#1 Used by ajax on the home/renew page
		 *		#2 Separated from the basic functionality of the views/home pages.
		 *	So when the engine is reused for other websites, the renew logic does not have to be rewritten
		 */
		function renew()
		{
			$step = $this->input->post('step');
			
			/** 
			*	Step is a flag sent via the initial renew form that tips us off to where we are in the renew process.
			*	If it's blank, we must be on the first step
			*/
			if( $step == '' )
			{
				$this->load->view('renew/renew');
			}
			elseif( $step == 'renew' )
			{
				$this->load->model('account');
				$this->load->model('account_type');
				$this->load->model('renew_pending');
				$this->load->model('coupon');
				
				// Retreive the coupon code (if its there)
				$coupon_code 	= $this->input->post('coupon_code');
				
				// Look it up in the database
				$coupon = $this->coupon->GetByCode( $coupon_code );
				
				/* If we got a coupon_code, but there was no match in the db, we have an error */
				if( $coupon_code && !$coupon )
				{
					$data['error'] = "The coupon you entered was not valid";
					$this->load->view('renew/renew', $data);
					return;
				}
				
				/* Users cannot renew with a trial offer */
				if( $coupon->is_trial )
				{
					$data['error'] = "The coupon you entered was not valid.";
					$this->load->view('renew/renew', $data);
					return;
				}
				
				/* Start  the renewal process */
				$user_id 		= $this->session->userdata('user_id');
				$site_name 		= $this->session->userdata('site_name');
				
				// Retreive the account
				$acct 		= $this->account->GetByUserId( $user_id );
				$acct_type 	= $this->account_type->GetById( config_item('individual_account_type_id') );
				
				$data['site_name'] 	= $site_name;
				$data['account_id'] = $acct->id;
				
				/* Based on the coupon, or the renewal deal, calculate the final price */
				$data['full_price'] = $acct_type->price;
				
				// Apply any discounts or offers given by the coupon
				if( $coupon )
				{
					// Deactivate the coupon it it's a single use coupon
					if( $coupon->is_single_use ) $this->coupon->Deactivate( $coupon->sales_person, $coupon->code );
					
					// Is the coupon for a free acount? Then skip the payment process
					if( $coupon->after_price == 0 )
					{
						$this->load->library('users');
						
						// Renew the user account from the pending entry in the database
						$this->users->RenewFromPending( $acct->id, $coupon->term_expiration );
						$this->load->view('renew/coupon_success');
						return;
					}
					else
					{
						/* The user got a discount from the coupon */
						$data['purchase_price'] = $coupon->after_price;
						$data['item_title']	= config_item('payment_item_base_title') . ' (renewal w/ coupon)';
					}
				}
				else
				{
					/* The user did not get a discount from the coupon */
					$data['purchase_price'] = $acct_type->renewal_deal_price;
					$data['item_title']		= config_item('payment_item_base_title') . ' (renewal)';
				}
				
				/* Calculate any savings the user got */
				$data['savings']	= ($acct_type->price - $data['purchase_price']);
				
				// Create a pending account in the database, and we'll wait for payment
				$this->renew_pending->Create( $acct->id, 
												$data['purchase_price'], 
												$coupon_code );
				
				$this->load->view('renew/payment', $data);
			}
			else
			{
				//If we get this, we got a step value that was manipulated by the user (probably)
			}
		}
		
		/**
		*	Like the renew function, encapsulated in ajax calls for easy reuse in future distributions of the system.
		*
		*/
		function register()
		{
			$step = $this->input->post('step');
			$this->load->helper('robot');
			
			if( $step == '')
			{	
				$qa 					= get_spam_check();
				$data['robot_question'] = $qa['question'];
				$this->session->set_userdata( array( 'robot_answer' => $qa['answer'] ) );
				
				$this->load->view('register/register', $data);
			}
			elseif( $step == 'register' )
			{
				// Validate data, check coupon
				$coupon_id 			= $this->input->post('coupon_id');
				$site_name 			= $this->input->post('site_name');
				$admin_password 	= $this->input->post('admin_password');
				$email 				= $this->input->post('email');
				$robot_answer 		= $this->input->post('verification');

				$this->load->model('coupon');
				$this->load->model('account_type');
				$this->load->library('form_validation');
				$this->load->model('site');
				$this->load->model('account_pending');
				$this->load->helper('utilities');
				
				if( $coupon_id ) $coupon = $this->coupon->GetActiveCouponsByCode( $coupon_id );
				
				$this->form_validation->set_error_delimiters('<li>', '</li>');
				$valid = $this->form_validation->run('register');
				
				/* Did the form pass validation? */
				if (! $valid )
				{
					$error = true;
					$data['errors'] .= validation_errors();
				}
				
				/* Did the user pass the robot test? */
				if( $robot_answer != $this->session->userdata('robot_answer') )
				{
					$error = true;
					$data['errors'] .= "<li>You did not answer the math question correctly.</li>";
				}

				/* Has this site name already been taken? Oh no! */
				if ($this->site->DoesSiteExist($site_name) || $this->account_pending->DoesPendingSiteExist($site_name))
				{
					$error = true;
					$data['errors'] .= "<li>The site name '$site_name' has already been taken. Try using dashes (-) or periods (.)</li>";
				}
				   
				/* Does the sitenanme conform to our standard? */
				if( ! is_valid_sitename( $site_name ) )
				{
					$error = true;
					$data['errors'] .= "<li>Site name not valid..</li>";
				}
				
				/* Did the user enetered a coupon, but it wasn't valid? */
				if( ! $coupon && $coupon_id )
				{
					$error = true;
					$data['errors'] .= '<li>The coupon you entered is invalid</li>';
				}
				
				$acct_type = $this->account_type->GetById( config_item('individual_account_type_id') );
				
				/* Past here, our data should be valid */
						
				if( $coupon && !$error )
				{
					/* What should the purchase price be based on the coupon? If it's free, we'll set up the account now! */
					if( $coupon->is_single_use ) $this->coupon->Deactivate( $coupon->sales_person, $coupon->code );
					
					if( $coupon->after_price == 0 )
					{
						$this->load->library('users');
						$this->load->helper('url');
						
						$account_info = array (
								'account_type_id' 		=> ($coupon->is_trial ? config_item('trial_account_type_id') : config_item('individual_account_type_id') ),
								'signup_coupon_code' 	=> $coupon->code,
								'starting_cost' 		=> $coupon->after_price,
								'payment_expiration' 	=> $this->coupon->getMySQLDateTimePlusDays( $coupon->term_expiration ),
								'comments' 				=> ''
											);
						// The account is a free one, so do what's necesarry to create a new account
						$this->users->CreateBasicAccount( $site_name, $admin_password, $email, $account_info );
						
						$this->load->view('register/coupon_success');
						return;
					}
					else 
					{ 
						$purchase_price 	= $coupon->after_price; 
						$discount_message 	= " (with coupon discount)";
					}
				}
				else
				{
					/* Purchase price is regular */
					$purchase_price = $acct_type->price;
				}
							
			
				/* We got this far, and we might be ready to pay */
				if( $error )
				{
					/* Validation errors */
					$qa 					= get_spam_check();
					$data['robot_question'] = $qa['question'];
					$this->session->set_userdata( array( 'robot_answer' => $qa['answer'] ) );
					$this->load->view('register/register', $data);
				}
				else
				{
					/* No errors! On to the payment page! */
					$this->account_pending->Create( $site_name, $admin_password, $email, $coupon_id, $purchase_price, false );
					
					$data['purchase_price'] = $purchase_price;
					$data['site_name'] 		= $site_name;
					$data['full_price'] 	= $acct_type->price;
					$data['savings']		= ($acct_type->price - $purchase_price);
					$data['item_title'] 	= config_item('payment_item_base_title') . " ($site_name) $discount_message";
					$this->load->view('register/payment', $data);			
				}
			}
			else
			{
				echo "Error. Go away.";
			}
		}
	}

?>