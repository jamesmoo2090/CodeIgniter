<?php

class Todolist extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('todolist_model');
	}	
	function index()
	{			
		$this->form_validation->set_rules('email_address', 'email address', 'max_length[256]');			
		$this->form_validation->set_rules('public_task', 'Public or Private', 'required|max_length[10]');			
		$this->form_validation->set_rules('list_name', 'List Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_name', 'Task Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_description', 'Task Description', '');			
		$this->form_validation->set_rules('task_status', 'Task Status', 'max_length[50]');			
		$this->form_validation->set_rules('file_url', 'Attach File', 'max_length[256]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('todolist_view');
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'email_address' => set_value('email_address'),
					       	'public_task' => set_value('public_task'),
					       	'list_name' => set_value('list_name'),
					       	'task_name' => set_value('task_name'),
					       	'task_description' => set_value('task_description'),
					       	'task_status' => set_value('task_status'),
					       	'file_url' => set_value('file_url')
						);
					
			// run insert model to write data to db
		
			if ($this->todolist_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('todolist/success');   // or whatever logic needs to occur
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
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
}
?>