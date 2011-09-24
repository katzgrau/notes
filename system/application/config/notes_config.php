<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* If the application is in testing mode, it will use unverified Payment IPNs */
$config['testing_mode'] = true;

/* Installation setting */
$config['data_model_import_filename'] = dirname(__FILE__) . '/../../../install/data-model.sql';

/* The default theme which will be loaded if none exists in the database */
$config['default_theme_id'] = 10;
// Groups are actually not used at the time of this writing. 
// The data model includes them in the event of future features or expansion
$config['default_group_id'] = 1;

$config['system_notification_email_recipients'] = array('admin@yoursite.com');

/* Account type Ids */
$config['individual_account_type_id']   = 1;
$config['group_account_type_id'] 		= 2;
$config['trial_account_type_id'] 		= 3;

/* Admin section credentials */
$config['admin_username'] = 'admin';
$config['admin_password'] = '';

/* Installation-specific settings (faceplate) */
$config['company_name'] 			= "<Site Name>";
$config['customer_name'] 			= "<Your Organization>"; // Only if selling to a group
$config['customer_service_email']   = "customer.service@site.builder.com";
$config['default_page_title']       ='Home';
$config['default_page_content']     = '<p>Welcome to organization!</p><p>This is your website\'s default text. You can edit this however you would like!</p>';
$config['renew_reminder_threshold'] = 10;
$config['hit_tracking_enabled']     = true;

/* Author settings */
$config['theme_viewer_themes_per_page'] 	= 4;
$config['editor_autosave_timeout_seconds'] 	= 45;

/* Mail Settings */
$config['mail_from_name'] 	= '<Site Name> Service';
$config['mail_from_address']= 'noreply@site.builder.com';
$config['mail_username'] 	= 'noreply@site.builder.com';
$config['mail_password'] 	= 'password';
$config['mail_host'] 		= 'ssl://smtp.example.com:465';
$config['mail_protocol'] 	= 'smtp';
$config['mail_port'] 		= 465;
$config['mail_use_auth']	= true;
$config['mail_max_send_attempts'] = 3;

/* Site specific settings */
$config['max_user_pages'] = 20;
$config['max_user_links'] = 30;
$config['max_user_sites'] = 1;

/* System settings */
$config['application_root'] = dirname(__FILE__) . '/../';
$config['plugins_root'] 	= dirname(__FILE__) . '/../plugins/';
$config['system_root'] 		= dirname(__FILE__) . '/../../';
$config['web_root'] 		= dirname(__FILE__) . '/../../../';
$config['enable_profiling'] = false;
$config['invalid_sitenames']= array(
                                        'home' 		=> true,
                                        'admin' 	=> true,
                                        'view' 		=> true,
                                        'ajax' 		=> true,
                                        'author' 	=> true,
                                        'sandbox' 	=> true,
                                        'sales' 	=> true,
                                        'install' 	=> true,
                                        'webservice'=> true,
                                        'api' 		=> true,
                                        'help'		=> true,
                                    );

/* Account configuration */
$config['pay_to_email']                     = "";
$config['individual_accounts_enabled']      = false;
$config['account_expiration_tolerance_days']= 30;
$config['pending_account_expiration_tolerance_hours'] 	= 24;
$config['max_sitename_length'] 				= 50;
$config['min_password_length']				= 5;
#$config['accounts_strategy_helper'] = 'accounts_plumber_helper';

/* Payment settings */
$config['payment_helper']           = 'paypal_payment_helper';
$config['payment_item_base_title'] 	= '<Site Name> 1 Year';

/* News Update logger */
$config['news_strategy_helper']             = 'twitter_helper';
$config['news_strategy_dictionary_entry'] 	= 'twitter_news';
$config['news_strategy_service_user'] 		= 'SiteBuilder';
$config['news_strategy_fetch_count'] 		= 5;
$config['news_strategy_cache_expiration_minutes'] = 30;

/* Ad-wise configuration */
$config['ads_enabled'] 			= false;
$config['ads_strategy_helper'] 	= 'ads_google_helper';
// This can be overridden by ad helpers for passing display logic to external services */
$config['ads_config'] 			= array	(
											'top_banner' 		=> false,
											'bottom_banner' 	=> false,
											'left_skyscraper' 	=> false,
											'right_skyscraper' 	=> false,
											'square_1' 			=> false,
											'square_2' 			=> false
										);
/* Plugins configuration */
$config['plugins_enabled'] = false;

/* Upload-wise Configuration */
$config['uploads_enabled']                  = false;
$config['uploads_enable_processing']		= false;
$config['uploads_strategy_helper']          = 'uploads_disk_helper';
$config['uploads_image_resize_threshold'] 	= 400;
$config['uploads_local_storage_path'] 		= dirname(__FILE__) . '/../../../public/uploads/';
$config['uploads_max_disk_usage_kb'] 		= 20000;
$config['uploads_max_file_size_kb'] 		= 2000;

/* Amazon S3 Configuration */
$config['aws_access_key'] 		= '';
$config['aws_secret_key'] 		= '';
$config['aws_bucket_name'] 		= '';
$config['aws_base_url']			= '';
$config['aws_uploads_folder']   = 'uploads/';
$config['aws_use_ssl'] 			= false;
$config['aws_delete_local_copy']= true;

/**
 * This is used to rewrite paths to certain views. This is so we can isolate
 * view files for the front end somewhere else. All paths are assumed to be
 * relative to BASEPATH
 */
$config['view_routes'] = array (
    'home\/(.*)$' => 'front-end/views/$1'
);