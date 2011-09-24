<?php

	class Page extends MY_Model
	{
		// TODO: Use query bindings (for security, and escaping query input
		// 	At bttom of: user_guide/database/queries.html
		
		function Create( $site_id, $page_title, $content, $published, $draft = true, $parent_id = 0 )
		{
			$this->load->helper('url');
			$this->load->helper('date');
			
			if( $published ) 
				$page_slug = $this->GetValidPageSlug( $site_id, $page_title );
			else
				$page_slug = url_title( $page_title );
			
			$data = 	array(
							'site_id' => $site_id,
							'parent_id' => $parent_id,
							'page_title' => $page_title,
							'page_slug' => $page_slug,
							'content' => $content,
							'is_draft' => $draft,
							'published' => ($published ? 1 : 0 ),
							'created' => $this->getMySQLDateTime(),
							'modified' => $this->getMySQLDateTime()
							);
			
			$this->db->insert('pages', $data); 
			
			return $this->db->insert_id();
		}
		
		function Save( $site_id, $page_id, $page_title, $content, $published, $draft = false, $parent_id = 0 )
		{
			$this->load->helper('url');
			
			if( $published ) 
				$page_slug = $this->GetValidPageSlug( $site_id, $page_title, $page_id );
			else
				$page_slug = url_title( $page_title );
			
			/* This page exists in the db, and we just need to update it */
			$data = array(
			   'page_slug' => $page_slug,
			   'page_title' => $page_title,
			   'content' => $content,
			   'is_draft' => $draft,
			   'parent_id' => $parent_id,
			   'published' => $published,
			   'modified' => $this->getMySQLDateTime()
			);
			
			$this->db->where('id', $page_id);	
			$this->db->where('site_id', $site_id);
			
			$this->db->update('pages', $data);

			return true;
		}
		
		function Unpublish( $site_id, $page_id )
		{
			/* Grab the most recent editing changes */
			$page = $this->page->GetPageDraft( $site_id, $page_id );
			
			/* Delete All Drafts */
			$this->Delete( $site_id, $page_id, true );
			
			/* Save the draft content to the published 'master' copy of the page, which is unpublished */
			$this->Save( $site_id, $page_id, $page->page_title, $page->content, $published = false, $draft = false );
			/* Creates the draft copy */
			$this->Create( $site_id, $page->page_title, $page->content, $published = false, $draft = true, $page_id );
		}

		function Delete( $site_id, $page_id, $revert_to_published = false )
		{
			if( !$revert_to_published )
			{
				$this->db->where('id', $page_id);
				$this->db->where('site_id', $site_id);
				$this->db->delete('pages'); 
			}
			
			$this->db->where('parent_id', $page_id);
			$this->db->where('site_id', $site_id);
			$this->db->delete('pages');
			
			return true;
		}
		
		function GetPageMeta( $siteName )
		{
			$sql = "SELECT p.id, p.page_title, p.page_slug, p.list_priority, p.created, p.modified
					FROM sites s, pages p
					WHERE s.site_name = ?
					AND p.site_id = s.id
					AND p.published = 1
					AND p.is_draft = 0
					ORDER BY p.list_priority";
			
			return $this->db->query( $sql, array ( $siteName ) )->result();
		}	
		
		function GetPages( $siteName )
		{
			$sql = "SELECT p.id, p.page_title, p.content, p.page_slug, p.list_priority, p.created, p.modified
					FROM sites s, pages p
					WHERE s.site_name = ?
					AND p.site_id = s.id
					AND p.published = 1
					AND p.is_draft = 0
					ORDER BY p.list_priority";
			
			return $this->db->query( $sql, array ( $siteName ) )->result();
		}
		
		function GetPageDraftMeta( $site_id, $limit = false )
		{
			// Prob: Need to get page drafts, if none exists, pull published page as draft
			
			$sql = "SELECT p.id as 'parent_id', p.page_title, p.page_slug, p.is_draft, p.published, p.list_priority, p.published, p.created, p.modified 
					FROM pages p, sites s
					WHERE s.id = ?
					AND p.site_id = s.id
					AND p.parent_id = 0
					AND (SELECT COUNT(*) FROM pages tp WHERE tp.parent_id = p.id) = 0
					ORDER BY p.parent_id";
			
			if( $limit ) $sql = "$sql LIMIT 0, $limit";
			
			$result_pub = $this->db->query( $sql, array( $site_id ) )->result();
			
			$sql = "SELECT p.parent_id, p.page_title, p.page_slug, p.is_draft, p.published, p.list_priority, p.published, p.created, p.modified 
					FROM pages p, sites s
					WHERE s.id = ?
					AND p.site_id = s.id
					AND p.parent_id <> 0
					AND p.modified = (SELECT MAX(tp.modified) 
										FROM pages tp
										WHERE (p.parent_id = tp.parent_id))
					ORDER BY p.parent_id";
					
			if( $limit ) $sql = "$sql LIMIT 0, $limit";
					
			$result_draft = $this->db->query( $sql, array( $site_id ) )->result();
			
			return array_merge( $result_pub, $result_draft );
		}
		
		function GetValidPageSlug( $site_id, $page_title, $page_id = false )
		{
			$this->load->helper('url');
			$page_slug = url_title( $page_title );
			
			$sql = "SELECT COUNT(*) AS 'count' 
					FROM pages
					WHERE page_slug = ?
					AND
					site_id = ?
					AND
					published = 1";
		
			if( $page_id ) $sql = "$sql AND id <> $page_id";
			
			$count 	= $this->db->query( $sql, array ( $page_slug, $site_id ) )->row()->count;
			$i 		= 0;
			
			while ( $count > 0 )
			{
				$i++;
				$new_slug = "$page_slug-$i";
				$count = $this->db->query( $sql, array ( $new_slug, $site_id ) )->row()->count;
				if( $count == 0 ) $page_slug = $new_slug;
			}
			
			return $page_slug;
		}
		
		function GetPage( $siteName, $pageSlug = false )
		{
			$sql = "SELECT s.display_name, p.*

						FROM sites s, pages p
						WHERE s.site_name = ?
						AND p.site_id = s.id
						AND p.published = 1";
			
			if( $pageSlug ) $sql = "$sql AND p.page_slug = ?";
			
			$sql = "$sql ORDER BY p.list_priority LIMIT 0, 1";
			
			$result = $this->db->query( $sql, array( $siteName, $pageSlug ) );
			
			return ($result->num_rows() > 0 ? $result->row() : null);
		}
		
		function GetPageDraft( $site_id, $page_id )
		{
			/* Look for a draft. If there isn't one, return the published page. */
			$sql = "SELECT s.display_name, p.parent_id, p.page_title, p.page_slug, p.content, p.list_priority, p.is_draft, p.published, p.created, p.modified 
						FROM sites s, pages p
						WHERE s.id = ?
						AND p.site_id = s.id
						AND p.is_draft = 1
						AND p.parent_id = ?
						ORDER BY p.modified DESC LIMIT 0, 1";
			
			$result = $this->db->query( $sql, array( $site_id, $page_id ) );
			
			if( $result->num_rows() > 0 )
				return $result->row();
			
			$sql = "SELECT s.display_name, p.page_title, p.page_slug, p.content, p.list_priority, p.is_draft, p.published, p.created, p.modified , ? AS 'parent_id'
						FROM sites s, pages p
						WHERE s.id = ?
						AND p.is_draft = 0
						AND p.site_id = s.id
						AND p.id = ?";
			
			$sql = "$sql ORDER BY p.modified LIMIT 0, 1";
			
			$result = $this->db->query( $sql, array( $page_id, $site_id, $page_id ) );
			
			return ($result->num_rows() > 0 ? $result->row() : null);
		}
		
		function GetPageCount()
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM pages";
			
			return $this->db->query($sql)->row()->count;
		}
		
		function GetPublishedPageCountBySiteId( $site_id )
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM pages
					WHERE pages.site_id = ? AND pages.published = 1";
			
			return $this->db->query($sql, array ( $site_id ) )->row()->count;
		}
		
		function DoesPublishedPageExist( $site_id, $page_slug )
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM pages WHERE published = 1 AND site_id = ? AND page_slug = ?";
			
			return ( $this->db->query( $site_id, $page_name )->row()->count > 0 );
		}		
		
		function DoesDraftPageExist( $site_id, $page_slug )
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM pages WHERE published = 0 AND site_id = ? AND page_slug = ?";
			
			return ( $this->db->query( $site_id, $page_name )->row()->count > 0 );			
		}	
		
		function IsLastPublishedPage( $site_id, $page_id )
		{
			$sql = "SELECT id, (SELECT COUNT(*) FROM pages p2 WHERE p2.published = 1 AND site_id = ?) AS 'count' 
					FROM pages
					WHERE site_id = ? AND id = ? AND published = 1";
			
			$data = $this->db->query( $sql, array ($site_id, $site_id, $page_id) )->row();

			if( $data->count == 1 && $data->id == $page_id ) return true;
			
			return false;
		}
		
		function HasPublishedVersion( $site_id, $page_id )
		{
			$sql = "SELECT id
					FROM pages
					WHERE site_id = ? AND id = ? AND published = 1";
			
			return ($this->db->query( $sql, array ($site_id, $page_id) )->num_rows() > 0);
		}
		
		function GetPageIdFromSlug( $site_id, $page_slug )
		{
			$sql = "SELECT id FROM pages WHERE site_id = ? AND page_slug = ? AND published = 1";
			
			$result = $this->db->query( $sql, array( $site_id, $page_slug ) );
			
			return ( $result ? $result->row()->id : false );
		}
	}
	
?>