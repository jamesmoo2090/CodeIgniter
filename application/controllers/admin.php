<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

   // creates the session
   public function __construct()
   {
      session_start();
      parent::__construct();
   }

	public function index()
  	{
  		//if the session is not created already will redirect to the login page
		if ( isset($_SESSION['username']) ) 
		{
			redirect('welcome');
		}

		//this will validate the form, the password is stored in the DB as a SHA1 
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

		//send the info from the form to the database for verification
		if ( $this->form_validation->run() !== false ) 
		{
			// then validation passed. Get from db
			$this->load->model('admin_model');
			$res = $this
				->admin_model
				->verify_user(
					$this->input->post('email_address'), 
					$this->input->post('password')
				);

			
			//if the session is not created, the user will be sent to the login page
			if ( $res !== false ) 
			{
            	$_SESSION['username'] = $this->input->post('email_address');
            	redirect('welcome');
			}

		}
		//once the user is logged in
		$this->load->view('login_view');
	}

	//logout function for the user
	public function logout()
	{
		session_destroy();
		$this->load->view('login_view');
	}
}
