<?php

class MY_Model extends Model {

    function MY_Model()
    {
        parent::Model();
    }
	
	function getMySQLDateTime() { return date( 'Y-m-d H:i:s' ); }
	
	function getMySQLDateTimePlusYears( $years ) 
	{
		$date = date('Y-m-d H:i:s');	
		return date( 'Y-m-d H:i:s', strtotime( "$date +$years years" ));
	}
	function getMySQLDateTimePlusWeeks( $weeks ) 
	{
		$date = date('Y-m-d H:i:s');	
		return date( 'Y-m-d H:i:s', strtotime( "$date +$weeks weeks" ));
	}
	function getMySQLDateTimePlusDays( $days ) 
	{
		$date = date('Y-m-d H:i:s');	
		return date( 'Y-m-d H:i:s', strtotime( "$date +$days days" ));
	}
}

?>