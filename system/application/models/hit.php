<?php

	class Hit extends MY_Model
	{
		function Record( $site_id, $page_id, $session_id )
		{
			$data = array	(
								'site_id'	 	=> $site_id,
								'page_id' 		=> $page_id,
								'session_id' 	=> $session_id,
								'created' 		=> $this->getMySQLDateTime()
							);
			
			$this->db->insert('hits', $data);
		}
		
		function GetPastHits( $site_id, $page_id = false )
		{
			if( $page_id )
			{
				$sql = "SELECT
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND page_id = ? AND created > DATE_SUB( NOW(), INTERVAL 1 DAY )) AS 'day',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND page_id = ? AND created > DATE_SUB( NOW(), INTERVAL 7 DAY )) AS 'week',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND page_id = ? AND created > DATE_SUB( NOW(), INTERVAL 31 DAY )) AS 'month',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND page_id = ? AND created > DATE_SUB( NOW(), INTERVAL 365 DAY )) AS 'year'
						";

				$result = $this->db->query( $sql, array( 	$site_id, $page_id,
															$site_id, $page_id,
															$site_id, $page_id,
															$site_id, $page_id ));
			}
			else
			{
				$sql = "SELECT
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND created > DATE_SUB( NOW(), INTERVAL 1 DAY )) AS 'day',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND created > DATE_SUB( NOW(), INTERVAL 7 DAY )) AS 'week',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND created > DATE_SUB( NOW(), INTERVAL 31 DAY )) AS 'month',
						(SELECT COUNT(*) FROM hits WHERE site_id = ? AND created > DATE_SUB( NOW(), INTERVAL 365 DAY )) AS 'year'
						";
						
				$result = $this->db->query( $sql, array( 	$site_id,
															$site_id,
															$site_id,
															$site_id ));
			}
			
			return $result->row();
		}
	}

?>