<?php

	class View extends Controller
	{
		function View()
		{
			parent::Controller();
		}
		
		function index()
		{
			
		}
		
		/* This is the method that actually displays a website */
		function site( $siteName, $page_slug = '' )
		{
			$this->load->library('user_agent');
			
			if( $this->agent->is_mobile() )
			{
				/* This is a mobile broswer. Load the 'mobile' view. */
				$this->load_website( $siteName, 'mobile', $page_slug );
			}
			else
			{
				/* Load the website as usual */
				$this->load_website( $siteName, null, $page_slug );
			}
		}
		
		function preview_theme()
		{
			/* Load the website with a specific theme. Requires query strings to be enabled */
			$theme_name = $this->input->get('theme_name');
			$site_name 	= $this->input->get('site_name');
			$page_slug 	= $this->input->get('page_slug');
			
			$this->load_website( $site_name, $theme_name, null );
		}
		
		private function load_website( $siteName, $theme_name = null, $pageSlug = '' )
		{
			$this->load->model('site');
			$this->load->model('page');
			$this->load->model('file');
			$this->load->model('user');

			$site = $this->site->GetSite( $siteName );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( !$site ) { show_404('error_404'); exit; }
			
			$sitePageMeta = $this->page->GetPageMeta( $siteName );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( sizeof( $sitePageMeta ) <= 0 ) { show_404('error_404'); exit; }
			
			$pageContent = $this->page->GetPage( $siteName, $pageSlug );
			
			/* Check to see that we got a valid result. If not, 404! */
			if( !$pageContent ) 
			{
				$pageContent->page_title 	= "Whoops! This page does not exist on this website!";
				$pageContent->content 		= '<a href="' . config_item('base_url') . $siteName . '">Click here</a> to see the front page of this website.';
				$pageContent->page_slug 	= $pageSlug;
			}
			
			$links = $this->site->GetLinks( $siteName );
			
			$files = $this->file->GetPageUploadsByName( $siteName, $pageContent->page_slug );
			
			$user = $this->user->GetUserBySiteName($siteName);
			
			/* Record this hit if necesarry */
			if( config_item('hit_tracking_enabled') )
			{
				$this->load->model('hit');
				
				$sid = $this->site->GetSiteId( $siteName );
				$pid = $pageContent->id;
				
				if( $pid )
				{
					$sess_id = $this->session->userdata('session_id');
					$this->hit->Record( $sid, $pid, $sess_id );
				}
			}
			
			$data['user'] 			= $user;
			$data['site'] 			= $site;
			$data['site_name'] 		= $siteName;
			$data['sitePageMeta'] 	= $sitePageMeta;
			$data['pageContent'] 	= $pageContent;
			$data['links'] 			= $links;
			$data['files'] 			= $files;
			
			$siteTheme = ($theme_name ? $theme_name : $site->theme_name );
			
			/* Call pre-view hook. The first hook ever installed! */
			call_plugin_hook('pre_view_load', $data );
			
			$this->load->view("themes/$siteTheme", $data);
		}

	}

?>