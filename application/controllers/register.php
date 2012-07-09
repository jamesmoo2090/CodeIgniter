<?php

class Register extends CI_Controller {
            
	//default constructors and load the helpers and form validation		   
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('registration_model');
	}	
	
	//Main function
	function index()
	{
		//START THE FORM VALIDATION
		$this->form_validation->set_rules('first_name', 'first_name', 'max_length[40]');			
		$this->form_validation->set_rules('last_name', 'last_name', 'max_length[40]');	
		$this->form_validation->set_rules('email_address', 'email_address', 'valid_email|required','max_length[50]');			
		$this->form_validation->set_rules('password', 'password', 'max_length[128]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//boiler plate
			//$this->load->view('register_view');
			
			$data['title']       = 'Register New Account';
			$data['main_content']= 'register_view';
						 
		$this->load->view('template',$data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'first_name' => set_value('first_name'),
					       	'last_name' => set_value('last_name'),
					       	'email_address' => set_value('email_address'),
					       	'password' => set_value('password')
						);
					
			// run insert model to write data to db
			
			$form_data['password'] = sha1(set_value('password'));
		
			if ($this->registration_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('register/success');   // or whatever logic needs to occur
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
	}
	function success()
	{
			redirect(admin);
	}
}
?>