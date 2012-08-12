<?php

class Password_sent extends CI_Controller 
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
			$data['title']       = 'Password Reset - Sent';
			$data['main_content']= 'sent_view';
						 
			$this->load->view('template',$data);
	}	
	

	
}	
	
?>
		