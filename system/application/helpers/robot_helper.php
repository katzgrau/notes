<?php 

if( ! function_exists('get_spam_check') )
{
	function get_spam_check()
	{
		$a = rand( 0, 10 );
		$b = rand( 0, 10 );
		
		return array ( 'question' => "What is $a + $b?",
						'answer' => ($a + $b) );
	}
}

?>