<?php

class Lists_model extends CI_Model 
{
	//default constructor
	function __construct()
	{
		
	}

	//this will search the database when called
	public function gettodo($email)
	{
		$q = $this
			->db
            ->where('email_address', $email)
            ->get('todolist');

		if ( $q->num_rows > 0 ) 
		{
			// person has account with us
         	return $q->row();
      	}
      	return false;
   }
	
		
}

