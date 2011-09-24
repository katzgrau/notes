<?php

	class Author extends Controller
	{
		function Author()
		{
			/* When this controller is loaded up, check that the user is logged in. If not, send him to the login page. */
			parent::Controller();
		
			$this->load->helper('url');
			$this->load->library('encrypt');
			
			/* Check that the user is logged in. If not, redirect to the login page */
			$site_id = $this->session->userdata('site_id');
			
			if ( ! $site_id ) 
			{
				redirect( 'home/login' );
			}
		}

		function index()
		{
			$this->desktop();
		}
		
		function desktop()
		{
			$this->load->model('preference');
			$this->load->model('hit');
			
			$site_name 	= $this->session->userdata('site_name');
			$user_id 	= $this->session->userdata('user_id');
			$site_id 	= $this->session->userdata('site_id');
			
			$data['hits'] 					= $this->hit->GetPastHits( $site_id );
			$data['show_intro_message']		= $this->preference->Get( $user_id, 'show_intro_message', 1 );
			$data['are_tooltips_enabled'] 	= $this->preference->Get( $user_id, 'tooltips_on', 1 );
			$data['site_name'] 				=  $site_name;
			$data['author_page'] 			= 'desktop';
			$this->load->view('author/desktop', $data);			
		}
		
		/**
		 *	The method accessed when a user needs to edit his page. If page_id is supplied,
		 *	the system will grab the most recent draft version of that page (parent_id = page_id).
		 *	If no draft version is available, it will grab the published version of the page.
		 *	If no page_id is supplied, the system will grab the first available draft it comes accross.
		 *		If there isn't a draft, it finds a published page.
		 *
		 *	The way it works internally when it comes to drafting:
		 *		Here are some properties of different types of pages:
		 *			unpublished: is_draft = false and published = false 
		*				Usually when a page is saved as a draft, but not published ever. parent_id = 0,
		*				A draft copy of it will be made also.
		*			published:	is_draft = false and published = true. This is the published version of a page,
		*				which may or may not have one or more draft versions. parent_id = 0
		*			draft:   is_draft = true and published = false
		*				A draft version of a published page. parent_id = id of published page.
		*				All drafts must have a master copy -- parent_id != 0
		 */
		function edit($page_id = false, $status = false)
		{
			log_message('debug', print_r( $_POST, true ) );
			/* Load up the editing page */
			$this->load->helper('url');
			$this->load->model('page');
			$this->load->model('file');
			$this->load->model('preference');
			
			/* Get the basic site information */
			$user_id 	= $this->session->userdata('user_id');
			$site_id 	= $this->session->userdata('site_id');
			$site_name 	= $this->session->userdata('site_name');
			
			$data['site_name'] =  $site_name;
			$data['page_meta'] =  $this->page->GetPageDraftMeta($site_id);
			
			/* Was a page id supplied in the request? If so, grab the page */
			if( $page_id ) 
			{
				$data['page'] 	=  $this->page->GetPageDraft($site_id, $page_id);
				$data['files'] 	= $this->file->GetPageUploads($site_id, $page_id);
			}
			elseif( $page_id == "new" ){ /* Do nothing! */}
			else
			{
				/* There wasn't a page id or a new page, so let's pull the front page of the site for editing by default */
				$front_page = $this->page->GetPageDraftMeta( $site_id, 1 );
				$front_page = $front_page[0];
				
				if( $front_page )
				{
					$data['page'] 	= $this->page->GetPageDraft( $site_id, $front_page->parent_id );
					$data['files'] 	= $this->file->GetPageUploads($site_id, $front_page->parent_id );
				}
			}
			
			if( config_item('hit_tracking_enabled') )
			{
				if( $page_id != "new" )
				{
					$pid = $data['page']->parent_id;
					$this->load->model('hit');
					$data['hits'] = $this->hit->GetPastHits( $site_id, $pid );
				}
				else
				{
					$data['hits'] = false;
				}
			}
			
			/* Include the TinyMCE editor javascript. We do this to keep the page running quickly when it isn't needed. */
			$data['include_rich_text_box_js'] 	= true;		
			$data['include_scriptaculous'] 		= true;
			
			/* Here are statuses which can be displayed. This should really be taken care of via flashdata */
			if( $status == "saved" )
				$data['notification'] = "The draft version of '{$data['page']->page_title}' has been saved. To publish, click 'Publish'";
			if( $status == "published" )
				$data['notification'] = "The page '{$data['page']->page_title}' has been published.";				
			if( $status == "unpublished" )
				$data['notification'] = "The page '{$data['page']->page_title}' has been unpublished.";	
			if( $status == "revert" )
				$data['notification'] = "The page '{$data['page']->page_title}' was reverted to its published version.";				
			if( $status == "limit" )
				$data['warning'] = "The page '{$data['page']->page_title}' was saved as a draft, but could not be published because you have reached the page limit.";
			if( $status == "upload_error" )
				$data['warning'] = "Your file could not be uploaded.";
			if( $status == "upload_limit" )
				$data['warning'] = "Your file could not be uploaded because you are over the upload quota (20 Mb)";
			if( $status == "uploaded" )
				$data['notification'] = "Your file was uploaded successfully.";
			if( $status == "page_min" )
				$data['warning'] = "You must have at least one page published.";
				
			$data['are_tooltips_enabled'] = $this->preference->Get( $user_id, 'tooltips_on', 1 );
			$data['author_page'] = 'edit';
			$data['include_modal'] = true;
			$data['has_published_version'] = $this->page->HasPublishedVersion( $site_id, $data['page']->parent_id );
			$this->load->view('author/edit', $data);
		}
		
		function save( $page_id = false )
		{
			$page_id = $this->_save( $page_id );
			redirect("author/edit/$page_id/saved");
		}
		
		//TODO: Start using JSON responses
		function ajax_save( $page_id = false )
		{
			/* return the page number */
			echo '' . $this->_save( $page_id );
		}
		
		/* Saves a draft -- does not make it publicly visible */
		private function _save( $page_id = false )
		{
			$this->load->model('page');
			$this->load->model('site');
			
			$site_id 	= $this->session->userdata('site_id');
			$page_title = $this->input->post('title');
			$content 	= $this->input->post('content');			
			
			if ( ! $page_title ) $page_title = "Untitled Page*";
			
			if( !$page_id )
			{
				/* New page. Create an unpublished master copy of the page, and retain the id */
				$page_id = $this->page->Create( $site_id, $page_title, $content, false, false, 0 );
			}
			
			/* Save a draft copy of the page. By this point, the page_id should refer the id of the parent page we're making a draft of */
			$this->page->Create( $site_id, $page_title, $content, false, $draft = true, $page_id );
			
			return $page_id;
		}
		
		/* Updates draft -- makes changes publicly visible */
		function publish( $page_id = false )
		{
			$this->load->model('page');
			
			$site_id 	= $this->session->userdata('site_id');
			$page_title = $this->input->post('title');
			$content 	= $this->input->post('content');
			
			if ( ! $page_title ) $page_title = "Untitled Page*";
			
			/* First make sure that the user hasn't exceeded the number of page that exist on a site */
			if( $this->page->GetPublishedPageCountBySiteId( $site_id ) <= config_item( 'max_user_pages' ) )
			{
				/* Next, if this is a new page being published immediately, create it in the db */
				if( !$page_id )
				{
					$page_id = $this->page->Create( $site_id, $page_title, $content, true, false, 0 );
				}
				else
				{
					/* If the page already exists, update it in the db */
					$this->page->Save( $site_id, $page_id, $page_title, $content, true );
					/* Get rid of all those drafts */
					$this->page->Delete($site_id, $page_id, true);
				}
			}
			else
			{
				/* If the user is past the published page limit, save the draft, but don't publish it */
				$page_id = $this->_save( $page_id );
				redirect("author/edit/$page_id/limit");
			}
			
			redirect("author/edit/$page_id/published");
		}
		
		/* Delete a page */
		function delete( $mode, $page_id )
		{
			$this->load->model('page');
			$this->load->helper('url');
			
			$site_id = $this->session->userdata('site_id');
			
			/* Don't let the user delete the last published page on the site */
			if( $this->page->IsLastPublishedPage( $site_id, $page_id ) == true )
			{
				redirect("author/edit/$page_id/page_min");
			}

			if( $mode == "all")
			{
				$this->page->Delete($site_id, $page_id);
			}
			elseif( $mode == "unpublish" )
			{
				$this->page->Delete($site_id, $page_id, true);
			}
			
			redirect("author/edit");
		}
		
		/* Get rid of all drafts, and keep the public version. This will essentially revert the page to the unpublished version. */
		function revert( $page_id )
		{
			$this->load->model('page');
			$this->load->helper('url');
			
			$site_id = $this->session->userdata('site_id');
			
			if ( $page_id && $site_id )
			{
				$this->page->Delete($site_id, $page_id, true);
				redirect("author/edit/$page_id/revert");
			}
			
			redirect("author/edit/$page_id");
		}		
		
		function unpublish( $page_id )
		{
			$this->load->model('page');
			$this->load->helper('url');
			
			$site_id = $this->session->userdata('site_id');

			/* Don't let the user delete the last published page on the site */
			if( $this->page->IsLastPublishedPage( $site_id, $page_id ) == true )
			{
				redirect("author/edit/$page_id/page_min");
			}
			
			if ( $page_id && $site_id )
			{
				$this->page->Unpublish( $site_id, $page_id );
				redirect("author/edit/$page_id/unpublished");
			}
			
			redirect("author/edit/$page_id");
		}
		
		/* This is the settings page method */
		function settings( $mode = false, $param = false )
		{
			$this->load->model('page');
			$this->load->model('site');
			$this->load->helper('url');
			$this->load->model('preference');
			
			$site_id = $this->session->userdata('site_id');
			$user_id = $this->session->userdata('user_id');
			
			if( $mode == "save" )
			{
				$display_name 		= $this->input->post('site_display_name');
				$new_link_url 		= $this->input->post('new_link_url');
				$new_link_title 	= $this->input->post('new_link_title');
				
				$this->site->SaveSite( $site_id, $display_name );
				
				/* If we have a link submitted, save it in the db */
				if( $new_link_url && $new_link_title)
				{
					/* Make sure that the user doesn't have too many links */
					if( $this->site->GetLinkCount( $site_id ) < config_item('max_user_links') )
					{
						$this->site->AddLink( $site_id, $new_link_title, prep_url($new_link_url) );
					}
					else
					{
						$data['warning'] = "You have exceeded the maximum number of links allowable.";
					}
				}
				
				$data['notification'] = "Your site settings have been saved.";
			}
			elseif( $mode == "set_theme" )
			{
				/* In this case, $param is the theme id. */
				if( $param )
				{
					$this->site->SetSiteTheme($site_id, $param);
					$data['notification'] = "Your theme selection has been saved.";
				}
			}
			else
			{
			}
			
			/* Load up all the data for displaying the page */
			$site_name = $this->session->userdata('site_name');
			$site_id = $this->session->userdata('site_id');
			
			$data['are_tooltips_enabled'] = $this->preference->Get( $user_id, 'tooltips_on', 1 );
			$data['site_name'] = $site_name;
			$data['siteMeta'] = $this->site->GetSite($site_name);
			$data['pageMeta'] = $this->page->GetPageMeta($site_name);
			$data['linkMeta'] = $this->site->GetLinks($site_name);
			$data['include_scriptaculous'] = true;
			$data['include_modal'] = true;
			$data['author_page'] = 'settings';
			
			$this->load->view('author/settings', $data);
		}
		
		/* This method is used when the user would be viewing/saving account information */
		function account($mode = false)
		{
			$this->load->model('user');
			$this->load->model('site');
			$this->load->model('preference');
			
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div>', '</div>');
			
			$site_name 	= $this->session->userdata('site_name');
			$site_id 	= $this->session->userdata('site_id');
			$user_id 	= $this->session->userdata('user_id');

				if( $mode == "save" )
				{
					/* If individual billing accounts are disabled, then those settings are hidden */
					if( config_item('individual_accounts_enabled') )
						$validation_result = $this->form_validation->run('accounts_individual');
					else
						$validation_result = $this->form_validation->run('accounts_group');
					
					/* Make sure that everything came out honkydory */
					if ($validation_result != FALSE)
					{
						$user_id 	= $this->session->userdata('user_id');
						$first_name = $this->input->post('first_name');
						$last_name 	= $this->input->post('last_name');
						$address 	= $this->input->post('address');
						$city 		= $this->input->post('city');
						$state 		= $this->input->post('state');
						$country 	= $this->input->post('country');
						$zip 		= $this->input->post('zip');
						$phone 		= $this->input->post('phone');
						$email 		= $this->input->post('email');
						$fax 		= $this->input->post('fax');
						
						$this->user->SaveUser($user_id, $first_name, $last_name, $address, $city, $state, $country, $zip, $phone, $email, $fax);
												
						$data['notification'] .= "Your account information has been saved.";
					}
					else
					{
						$data['warning'] .= validation_errors();
					}
					
					/* Check for a password change */
					$current_password 	= $this->input->post('current_password');
					$new_password 		= $this->input->post('new_password');
					$new_password_again	= $this->input->post('new_password_again');
					
					if( strlen( $current_password ) > 0 )
					{
						if( $new_password == $new_password_again )
						{
							if( trim( strlen( $new_password ) ) >= config_item('min_password_length') )
							{
								if( ! $this->site->ChangeSitePassword( $site_name, $current_password, $new_password ) )
								{
									$data['warning'] .= "<div>Your current password was not correct.</div>";
								}
							}
							else
							{
								$data['warning'] .= "<div>Your password must be longer than 5 characters</div>";
							}
						}
						else
						{
							$data['warning'] .= "<div>The new passwords you entered did not match</div>";
						}
					}

				}
			
			$data['are_tooltips_enabled'] 	= $this->preference->Get( $user_id, 'tooltips_on', 1 );
			$data['site_name'] 				= $site_name;
			$data['user'] 					= $this->user->GetUserBySiteId( $site_id );
			$data['include_scriptaculous'] 	= true;
			$data['author_page'] 			= 'account';
			
			$this->load->view('author/account', $data);
		}
		
		/* This is really an ajax function */
		function remove_file( $page_id, $file_id )
		{
			$this->load->model('file');
			$this->load->helper('url');
			$this->load->helper( config_item('uploads_strategy_helper') );
			
			$site_id = $this->session->userdata('site_id');
			
			$file_obj = $this->file->GetFile( $site_id, $file_id );
			
			$site_id 	= $this->session->userdata('site_id');
			$site_name 	= $this->session->userdata('site_name');
			
			if( delete_uploaded_file( $site_name, $file_obj ) )
				$this->file->DeleteFile( $site_id, $page_id, $file_id );
			
		}
		
		/* This is for insertion into the page, like contact information, office hours, etc */
		function get_template( $template_name )
		{
			// Dynamic templats first
			if( $template_name == "monthly-calendar")
			{
				$data['month'] 	= $this->input->post("month");
				$data['year'] 	= $this->input->post("year");
			}
			elseif( $template_name == "contact-information" )
			{
				$site_id 		= $this->session->userdata('site_id');
				$this->load->model('user');
				$data['user'] 	= $this->user->GetUserBySiteId( $site_id );
			}
			else
			{
				// In this case, it's a static template, so nothing needs to be done.
			}
			
			$this->load->view( "templates/{$template_name}", $data );
		}
		
		/* Show a little page which contains all the templates a user can display */
		function insert_template()
		{	
			$this->load->view('author/insert_template');
		}
		
		/** 
		  *  Upload an image to a page. It takes a page_id the image is associated with, and will perform uploading, 
		  *  basic resizing and alignment generation. On success, it loads the insert_image view, which (by javascript), will insert the 
		  *  markup generated into the tinymce editor .
		*/
		function upload_image( $page_id )
		{
			$step 				= $this->input->post('step');
			$resize_threshold 	= config_item('uploads_image_resize_threshold');
			
			if( $step == "upload" )
			{
				$this->load->helper( config_item('uploads_strategy_helper') );
				
				$position 	= $this->input->post('position');
				$resize 	= strtolower( $this->input->post('resize') ) == "on" ? true: false;
				$meta 		= $this->do_upload( $page_id, true );

				$data['site_name'] = $this->session->userdata('site_name');
				$data['file_name'] = $meta['file_name'];
				
				$img_path = $meta['full_path'];
				
				if( $resize && $meta['image_width'] > $resize_threshold )
				{
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $img_path;
					$config['create_thumb'] 	= FALSE;
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] 			= $resize_threshold;
					$config['height'] 			= $resize_threshold;

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				}
				
				if( $position != "center" )
					$data['markup'] = '<img hspace="10" vspace="10" align="'. $position .'" src="' . generate_uploaded_file_url( base_url(), $data['site_name'], $data['file_name'] ) .'" />';
				else
					$data['markup'] = '<br /><p style="text-align:center;"><img src="' . generate_uploaded_file_url( base_url(), $data['site_name'], $data['file_name'] ) .'" /></p><br />';
				
				$this->load->view( 'author/insert_image', $data );
			}
			else
			{
				$data['page_id'] = $page_id;
				$this->load->view('author/upload_image', $data);
			}
		}
		
		/* The public upload method */
		function upload( $page_id )
		{
			$this->do_upload( $page_id );
		}
		
		/** The private upload method. It will upload anything posted under the POST variable name 'userfile', and associate it with a page in the db.
		 *	It returns meta information associated with the upload
		 */
		private function do_upload($page_id, $ret = false)
		{
			$this->load->model('file');
			$this->load->helper('url');
			$this->load->helper( config_item('uploads_strategy_helper') );
			
			log_message('debug', 'File Upload request...');
			
			$site_id 	= $this->session->userdata('site_id');
			$site_name 	= $this->session->userdata('site_name');
			$file_path 	= config_item('uploads_local_storage_path') . $site_name;
			
			/* Yes, it works for directories too! */
			if( ! file_exists( $file_path ) ) @mkdir( $file_path );
			
			$conf = array( 	
							'upload_path' => $file_path,
							'allowed_types' => 'zip|pdf|ppt|pptx|xls|csv|doc|docx|rtf|txt|mp3|wav|jpg|gif|png|bmp|html|rar|gz|tar|*',
							'max_size' => '0',
							'remove_spaces' => true
						);
						
			$this->load->library('upload', $conf);

			/* Make sure the user isn't over his alotted file space */
			if( $this->file->GetFileUsageBySite( $site_id ) < config_item('uploads_max_disk_usage_kb') )
			{
				if ( ! $this->upload->do_upload())
				{
					log_message('debug', $this->upload->display_errors());
					
					if( !$ret ) redirect("author/edit/$page_id/upload_error");
				}	
				else
				{
					$ci_meta_data 	= &$this->upload->data();
					$file_name 		= $ci_meta_data['file_name'];
					
					/* Hand possible naming conflictions based on what's available in the database */
					$count = 1;
					while( $this->file->NameCollisionExists( $site_id, $file_name ) )
					{
						$file_name = "$count-" . $ci_meta_data['file_name'];
						$count++;
					}
					
					// Where does this user's uploads belong?
					$user_uploads_root = config_item('uploads_local_storage_path') . "$site_name/";
					
					// Rename the file on the disk so the db is synced with the file system
					@rename( $user_uploads_root . $ci_meta_data['file_name'], $user_uploads_root . $file_name );
					
					// Changed the meta data. This will be inserted in th db
					$ci_meta_data['file_name'] = $file_name;
					
					$this->file->Save($site_id, $page_id, $ci_meta_data, $ci_meta_data['is_image'] );
					
					if( !$ret ) redirect("author/edit/$page_id/uploaded");
				}
				
			}
			else
			{
				if( !$ret ) redirect("author/edit/$page_id/upload_limit");
			}
			
			return $ci_meta_data;
		}
		
		function tooltips_on( $return = "" )
		{
			$this->load->model('preference');
			$this->load->helper('url');
			
			$user_id = $this->session->userdata('user_id');
			
			if( $user_id ) $this->preference->Set($user_id, 'tooltips_on', 1);
			
			redirect("author/$return");
		}
		
		function tooltips_off( $return = "" )
		{
			$this->load->model('preference');
			$this->load->helper('url');
			
			$user_id = $this->session->userdata('user_id');
			
			if( $user_id ) $this->preference->Set($user_id, 'tooltips_on', 0);		
			
			redirect("author/$return");
		}
		
		function disable_intro_message( $return = "" )
		{
			
			$this->load->model('preference');
			$this->load->helper('url');
			
			$user_id = $this->session->userdata('user_id');
			
			if( $user_id ) $this->preference->Set($user_id, 'show_intro_message', 0);
			
			redirect("author/$return");
		}
	}

?>