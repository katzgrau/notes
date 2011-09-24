<?php

	class File extends MY_Model
	{
		function GetFileCount()
		{
			$sql = "SELECT COUNT(*) AS 'count' FROM files";
			
			return $this->db->query($sql)->row()->count;
		}
		
		function GetFileDiskUsage()
		{
			$sql = "SELECT SUM(file_size) AS 'kbytes' FROM files";
			
			return $this->db->query($sql)->row()->kbytes;
		}
		
		function GetTopSiteFileUsage($top_x = 10)
		{
			$sql = "SELECT SUM( files.file_size ) AS  'file_usage', sites.id, sites.site_name
					FROM files, sites
					WHERE files.site_id = sites.id
					GROUP BY sites.id
					ORDER BY file_usage DESC 
					LIMIT 0 , ?";
					
			return $this->db->query($sql, array( $top_x ))->result();
		}
		
		function GetFileUsageBySite( $site_id )
		{
			$sql = "SELECT SUM( files.file_size ) AS 'file_usage'
					FROM files
					WHERE site_id = ?";
					
			return $this->db->query( $sql, array ( $site_id ) )->row()->file_usage;
		}
		
		function Save($site_id, $page_id, &$ci_meta_data, $is_insertable_image = false)
		{
			$data = array(
							'site_id' => $site_id,
							'page_id' => $page_id,
							'file_name' => $ci_meta_data['file_name'],
							'file_ext' => $ci_meta_data['file_ext'],
							'orig_name' => $ci_meta_data['orig_name'],
							'file_type' => $ci_meta_data['file_type'],
							'file_size' => $ci_meta_data['file_size'],
							'is_image' => $ci_meta_data['is_image'],
							'is_insertable_image' => $is_insertable_image,
							'created' => $this->getMySQLDateTime(),
							'height_px' => $ci_meta_data['image_height'],
							'width_px' => $ci_meta_data['image_width'],
							'to_be_processed' => true,
							'is_stored_locally' => true
						 );
			
			$this->db->insert('files', $data);
		}
		
		function GetPageUploads( $site_id, $page_id )
		{
			$sql = "SELECT * FROM files WHERE
					site_id = ? AND page_id = ?";
					
			return $this->db->query( $sql, array( $site_id, $page_id ) )->result();
		}
		
		function GetPageUploadsByName($site_name, $page_slug)
		{
			$sql = "SELECT files.*
					FROM files, sites, pages
					WHERE files.site_id = pages.site_id
					AND files.page_id = pages.id
					AND pages.site_id = sites.id
					AND pages.page_slug = ?
					AND sites.site_name = ?";
			
			return $this->db->query( $sql, array( $page_slug, $site_name ) )->result();
		}		
		
		function GetSiteUploads( $site_name )
		{
			$sql = "SELECT pages.page_slug, files.*
					FROM files, sites, pages
					WHERE files.site_id = pages.site_id
					AND files.page_id = pages.id
					AND pages.site_id = sites.id
					AND sites.site_name = ?";
			
			return $this->db->query( $sql, array( $site_name ) )->result();
		}
		
		function GetFileNameFromId( $file_id )
		{
			$sql = "SELECT file_name FROM files WHERE id = ?";
			
			return $this->db->query($sql, array( $file_id ) )->row()->file_name;
		}		
		
		function GetFile( $site_id, $file_id )
		{
			$sql = "SELECT * FROM files WHERE site_id = ? AND id = ?";
			
			return $this->db->query($sql, array( $site_id, $file_id ) )->row();
		}
		
		function DeleteFile( $site_id, $page_id, $file_id )
		{
			/* site_id and page_id needed for security purposes */
			
			$sql = "DELETE FROM files 
					WHERE site_id = ?
					AND page_id = ?
					AND id = ?";
					
			$this->db->query($sql, array( $site_id, $page_id, $file_id ) );
		}
		
		function SetToBeProcessed( $file_id, $value )
		{
			$sql = "UPDATE files SET to_be_processed = ? WHERE id = ?";
			
			return $this->db->query( $sql, array( $value, $file_id ) );
		}	
		
		function SetIsStoredLocally( $file_id, $value )
		{
			$sql = "UPDATE files SET is_stored_locally = ? WHERE id = ?";
			
			return $this->db->query( $sql, array( $value, $file_id ) );
		}
		
		function GetFilesToBeProcessed()
		{
			$sql = "SELECT files.*, sites.site_name AS 'owner_site_name'
					FROM files, sites
					WHERE 
						files.to_be_processed = 1
					AND
						files.site_id = sites.id";
			
			return $this->db->query( $sql )->result();
		}	
		
		function NameCollisionExists( $site_id, $file_name )
		{
			$sql = "SELECT COUNT(*) as 'count' FROM files 
					WHERE
						site_id = ?
					AND
						file_name = ?
					";
			
			$result = $this->db->query( $sql, array( $site_id, $file_name ) )->row();
			
			return ($result->count > 0);
		}
	}

?>