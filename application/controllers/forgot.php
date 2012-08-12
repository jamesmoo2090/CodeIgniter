<?php

class Forgot extends CI_Controller 
{
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('registration_model');
	}	
	
	function index()
	{
		$this->form_validation->set_rules('email_address', 'email_address', 'valid_email|required','max_length[50]|required','required');			
		$this->form_validation->set_error_delimiters('<br /><span class="error" style="color:red"><b>', '</b></span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//boiler plate
			//$this->load->view('register_view');
			
			$data['title']       = 'Register New Account';
			$data['main_content']= 'forgot_view';
						 
			$this->load->view('template',$data);
		}
		else 
		{
			$form_data = array('email_address' => set_value('email_address'));
			
			$data['title']       = 'Password Sent';
			$data['main_content']= 'forgotconfirm_view';
						 
			$this->load->model('forgot_model');		 
			$this->forgot_model->recover($form_data);

			
		}	
	}
		
	
}
?>