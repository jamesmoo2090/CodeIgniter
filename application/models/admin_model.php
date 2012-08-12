<?php

class Admin_model extends CI_Model 
{
	//default constructor
	function __construct()
	{
		
	}

	//this will search the database when called
	public function verify_user($email, $password)
	{
		$q = $this
			->db
            ->where('email_address', $email)
            ->where('password', sha1($password))
            ->limit(1)
            ->get('users');

		if ( $q->num_rows > 0 ) 
		{
			// person has account with us
         	return $q->row();
      	}
		if ($q->num_rows == 0)
		{
			echo '<div style="background-color:red">';
			echo '<blink><center><b>';
			echo 'LOGIN FAILED - Check Email & Password';
			echo '</blink></center></b></div>';
		}
      	return false;
   }
	
		
}

