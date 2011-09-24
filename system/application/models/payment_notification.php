<?php 

class Payment_notification extends MY_Model
{
	function Create( $site_name, $account_id, $purchase_price, $content, $is_valid, $sender_ip )
	{	
		$data = array (
					'site_name' => $site_name,
					'account_id' => $account_id,
					'purchase_price' => $purchase_price,
					'content' => $content,
					'is_valid' => $is_valid,
					'sender_ip' => $sender_ip,
					'created' => $this->getMySQLDateTime()
					);
					
		$this->db->insert('payment_notifications', $data );
	}
}

?>