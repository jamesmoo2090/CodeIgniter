<?php

class Forgot_model extends CI_Model {

	//default constructor
	function __construct()
	{
		parent::__construct();
	}
	


	//get the info from the from and the controller and insert into the database 
	function recover($form_data)
	{
		$this->load->database();
		
		$email = $form_data['email_address'];
		$temppass = sha1('TempPassword');
		
		$check = $this->db->query('SELECT * FROM users WHERE email_address="'.$email.'"');
		
		if ($check->num_rows == 0)
		{
			redirect(Password_sent);
		}
		else 
		{
			//when the email is in the database
			$q = $this->db->query('UPDATE users SET password="'.$temppass.'" WHERE email_address="'.$email.'"');
			redirect(Password_sent);
		}
		
		

		/* SEND THE EMAIL WITH NEW PASSWORD TO USER: THERE IS NO NAIL SERVER CONFIGURED - commented out
		$this->load->library('email');
		$this->email->from('PasswordReset@TodoList.com', 'Password Reset');
		$this->email->to($email); 
		$this->email->subject('TodoList - Password Reset');
		$this->email->message('Your password has been reset to: TempPassword'); 
		$this->email->send();*/

	}
	

}
?>