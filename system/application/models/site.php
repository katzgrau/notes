<?php

	class Site extends MY_Model
	{

		function GetSite( $siteName )
		{
			$sql = "SELECT sites.*, themes.theme_name FROM sites, themes
					WHERE site_name = ?
					AND sites.theme_id = themes.id";
			
			$result = $this->db->query( $sql, array( $siteName ) );
			
			return ($result->num_rows() > 0 ? $result->row() : null);
		}
		
		function GetSiteCount()
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM sites";
			
			return $this->db->query($sql)->row()->count;
		}
		
		function GetSiteId( $site_name )
		{
			$sql = "SELECT id FROM sites WHERE site_name = ?";
			
			$result = $this->db->query( $sql, array( $site_name ) );
			
			return ( $result ? $result->row()->id : false );
		}

		function GetSiteById( $siteId )
		{
			$sql = "SELECT sites.*, themes.theme_name FROM sites, themes
					WHERE id = ?
					AND sites.theme_id = themes.id";
			
			$result = $this->db->query( $sql, array( $siteId ) );
			
			return ($result->num_rows() > 0 ? $result->row() : null);			
		}
		
		function Create( $user_id, $site_name, $admin_password )
		{
			$data = array(
							'user_id' => $user_id,
							'site_name' => $site_name,
							'admin_password' => $admin_password,
							'display_name' => $site_name,
							'theme_id' => config_item('default_theme_id'),
							'created' => $this->getMySQLDateTime(),
							'modified' => $this->getMySQLDateTime()
						 );
			
			$this->db->insert('sites', $data);
			
			return $this->db->insert_id();
		}
		
		function SaveSite( $site_id, $display_name )
		{
			$data = array(
							'display_name' => $display_name,
							'modified' => $this->getMySQLDateTime()
						 );
			
			$this->db->where('id', $site_id);
			$this->db->update('sites', $data);
		}
		
		function AddLink( $site_id, $title, $url )
		{
			$data = array ( 'site_id' => $site_id,
							'title'   => $title,
							'url'	  => $url,
							'created' => $this->getMySQLDateTime(),
							'modified'=> $this->getMySQLDateTime());
							
			$this->db->insert('links', $data);
			
			return $this->db->insert_id();
		}
		
		function RemoveLink( $site_id, $link_id )
		{
			$sql = "DELETE FROM links 
					WHERE site_id = ? AND id = ?";
			
			$this->db->query($sql, array( $site_id, $link_id ) );
		}
		
		function GetLinkCount( $site_id )
		{
			$sql = "SELECT COUNT(id) AS 'count'
					FROM links
					WHERE site_id = ?";
			
			return $this->db->query($sql, array( $site_id ) )->row()->count;
		}
		
		function GetLinks( $siteName )
		{
			$sql = "SELECT l.*
						FROM sites s, links l
						WHERE s.site_name = ?
						AND l.site_id = s.id
						ORDER BY l.list_priority";
			
			$result = $this->db->query( $sql, array( $siteName ) );
			
			return $result->result();
		}
		
		function GetIdFromSiteName( $siteName )
		{
			$sql = "SELECT sites.id FROM sites
					WHERE sites.site_name = ?";
					
			$result = $this->db->query( $sql, array( $siteName ) );
			
			return ($result->num_rows() > 0 ? $result->row()->id : null);
		}
		
		function SetPageListPriority($site_id, $id, $priority)
		{
			#echo "Site Id: $site_id ; Id: $id ; Pri: $priority ;";
			$this->db->where('site_id', $site_id);
			$this->db->where('id', $id);
			$this->db->update( 'pages', array( 'list_priority' => $priority ) );
		}

		function SetLinkListPriority($site_id, $id, $priority)
		{
			#echo "Site Id: $site_id ; Id: $id ; Pri: $priority ;";
			$this->db->where('site_id', $site_id);
			$this->db->where('id', $id);
			$this->db->update( 'links', array( 'list_priority' => $priority ) );
		}
		
		function GetSitePageCount( $site_id )
		{
			$sql = "SELECT COUNT(*) AS 'Count' FROM pages WHERE site_id = ?";
			
			return $this->db->query($sql, array( $site_id ))->row()->Count;
		}
		
		function SetSiteTheme( $site_id, $theme_id )
		{
			$data = array(
							'theme_id' => $theme_id
						 );
			
			$this->db->where( 'id', $site_id );
			
			$this->db->update( 'sites', $data );
		}
			
		function ChangeSitePassword($site_name, $current_pass, $new_pass)
		{
			if( $this->CheckSiteLogin( $site_name, $current_pass ) )
			{
				$this->db->where('site_name', $site_name);
				$this->db->update('sites', array( 'admin_password' => $new_pass ) );
				return true;
			}
			else return false;
		}
		
		function CheckSiteLogin($site_name, $password)
		{
			$sql = "SELECT id FROM sites WHERE site_name = ? AND admin_password = ?";
			
			$result = $this->db->query( $sql, array( $site_name, $password ) );
			
			return (($result->num_rows() > 0) ? true : false);
		}
		
		function DoesSiteExist( $site_name )
		{
			$sql = "SELECT id FROM sites WHERE site_name = ?";
			
			$result = $this->db->query( $sql, array( $site_name ) );
			
			return (($result->num_rows() > 0) ? true : false);		
		}
		
		function Search( $keyword )
		{
			$keyword = $this->input->xss_clean($keyword);
			
			$sql = "SELECT sites.site_name, users.first_name, users.last_name, users.email
					FROM sites, users
					WHERE sites.user_id = users.id
					AND (
						sites.site_name LIKE '%$keyword%' OR
						users.first_name LIKE '%$keyword%' OR
						users.last_name LIKE '%$keyword%')";
			
			return $this->db->query( $sql, array( $keyword ) )->result();
		}
	}
	
?>