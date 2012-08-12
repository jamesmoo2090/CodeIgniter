<?php

class Registration_model extends CI_Model {

	//default constructor
	function __construct()
	{
		parent::__construct();
	}
	


	//get the info from the from and the controller and insert into the database 
	function SaveForm($form_data)
	{
		//this will check to see if the email is already on the list
		$email = $form_data['email_address'];
		$q = $this
			->db
            ->where('email_address', $email)
            ->get('todolist');
		
		
		if ( $q->num_rows == 0)
		{
			$this->db->insert('users',$form_data);
			if ($this->db->affected_rows() == '1')
			{
				return TRUE;
			}
			else 
			{
				echo "ERROR - UNABLE TO SAVE TO THE DATABASE";
			}
			
		}
		if ($q->num_rows > 0)
		{
			echo "Email Already in DB";
			redirect(forgot);
		}	
	}
}