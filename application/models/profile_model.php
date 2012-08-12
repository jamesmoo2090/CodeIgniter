<?php

class Profile_model extends CI_Model {

	//default constructor
	function __construct()
	{
		parent::__construct();
	}
	


	//get the info from the from and the controller and insert into the database 
	function updateuser($form_data)
	{
		$this->load->database();
		
		//get data from the form into usable variables
		$first_name 	= $form_data['first_name'];
		$last_name  	= $form_data['last_name'];
		$email_address 	= $form_data['email_address'];
		$password  		= $form_data['password'];
		$oldemail 		= $form_data['oldemail'];
		
		/*	
		foreach ($form_data as $row)
		{
			echo "<p>";
			echo $row;
		}
		
	
		//perform a check to see if the user is in the DB
		$check = $this->db->query('SELECT * FROM users WHERE email_address="'.$oldemail.'"');
		
		
		if ($check->num_rows == 0)
		{
			//echo $oldemail;
			//echo $email_address;
			//echo $first_name;
			//echo $last_name;
			echo "ERROR - Could not update your user information";
		}
		else 
		{*/
			//update the user profile
			$update = 'UPDATE users SET first_name="'.$first_name.'" , last_name="'.$last_name.'" , email_address="'.$email_address.'" , password="'.$password.'" WHERE email_address="'.$oldemail.'"';
			$q = $this->db->query($update);

			//update all the email on the lists created, public and private
			$updatelists = 'UPDATE todolist SET email_address="'.$email_address.'" WHERE email_address="'.$oldemail.'"';
			$r = $this->db->query($updatelists);
						
			
			redirect(user_updated);
		//}


	}
	

}
?>