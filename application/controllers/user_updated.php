<?php

class User_updated extends CI_Controller {
            
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
				$data = array (	 'title' => 'User Updated - Success',
						 'main_content' => 'userupdated_view'
						 );
		$this->load->view('template', $data);
	}
}
?>