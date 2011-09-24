<?php

	class Theme extends MY_Model
	{
		function GetThemesByPage($page, $num_per_page, $user_id = false)
		{
			$start = ($page - 1) * $num_per_page;

			if( $start < 0 ) return array();

                        if($user_id)
                        {
                            $sql = "SELECT * FROM themes
                                    WHERE is_public
                                    OR id IN (SELECT theme_id FROM user_themes WHERE user_id = $user_id)
                                    ORDER BY list_priority
                                    LIMIT ?, ? ";
                        }
                        else
                        {
                            $sql = "SELECT * FROM themes ORDER BY list_priority LIMIT ?, ? ";
                        }
                        
                        return $this->db->query( $sql, array( $start, $num_per_page ) )->result();
		}
		
		function GetThemeById( $theme_id, $user_id = false )
		{
                    if(! $user_id)
                    {
			$sql = "SELECT * FROM themes WHERE id = ?";
                    }
                    else
                    {
                        $sql = "SELECT * FROM themes
                                WHERE id = ?
                                AND (is_public
                                     OR
                                     id IN (SELECT theme_id FROM user_themes WHERE user_id = $user_id))";
                    }
			return $this->db->query( $sql, array( $theme_id ) )->row();
		}
		
		function GetThemeCount($user_id = false)
		{
                    if(!$user_id)
			$sql = "SELECT COUNT(*) AS 'count' FROM themes";
                    else
                        $sql = "SELECT COUNT(*) AS 'count' FROM themes
                                WHERE is_public OR id IN
                                 (SELECT theme_id FROM user_themes WHERE user_id = $user_id)";
			
			return $this->db->query($sql)->row()->count;
		}
	}

?>