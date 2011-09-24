<?php
	
	$config = array(
		'change_password'			=> array (
							array(
								 'field'   => 'current_password',
								 'label'   => 'Current Password',
								 'rules'   => 'required'
							  ),
							array(
								 'field'   => 'new_password',
								 'label'   => 'Password',
								 'rules'   => 'required|matches[new_password]|min_length[5]'
							  ),
							array(
								 'field'   => 'new_password_again',
								 'label'   => 'Password (Again)',
								 'rules'   => 'required'
							  )
							),
		'accounts_group' =>	array(
						   array(
								 'field'   => 'first_name',
								 'label'   => 'First Name',
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'last_name',
								 'label'   => 'Last Name',
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'email',
								 'label'   => 'Email',
								 'rules'   => 'required|valid_email'
							  )
						),
		'register' => array (
						array(
								'field'   => 'site_name',
								'label'   => 'Site Name',
								'rules'   => 'min_length[4]|required'
						),
						array(
								'field'   => 'email',
								'label'   => 'Email',
								'rules'   => 'valid_email|required'
						),
						array(
								'field'   => 'admin_password',
								'label'   => 'Password',
								'rules'   => 'min_length[5]|required'
						),
						array(
								'field'   => 'admin_password_again',
								'label'   => 'Password Re-entry',
								'rules'   => 'matches[admin_password]|required'
						),
						array(
								'field'   => 'verification',
								'label'   => 'Human Verification',
								'rules'   => 'required'
						)
					),
		'accounts_individual' => 	array(/*
							array(
								 'field'   => 'first_name',
								 'label'   => 'First Name',
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'last_name',
								 'label'   => 'Last Name',
								 'rules'   => 'required'
							  ), */
						   array(
								 'field'   => 'email',
								 'label'   => 'Email',
								 'rules'   => 'required|valid_email'
							  ) /*,
						   array(
								 'field'   => 'address',
								 'label'   => 'Address',
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'city',
								 'label'   => 'City',
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'state',
								 'label'   => 'State',
								 'rules'   => 'required'
							  ),   
						   array(
								 'field'   => 'zip',
								 'label'   => 'Zip',
								 'rules'   => 'required'
							  ),   
						   array(
								 'field'   => 'country',
								 'label'   => 'Country',
								 'rules'   => 'required'
							  ),   
						   array(
								 'field'   => 'phone',
								 'label'   => 'Phone',
								 'rules'   => 'required'
							  ),   
						   array(
								 'field'   => 'fax',
								 'label'   => 'Fax',
								 'rules'   => 'required'
							  ) */
						) 
					);

?>