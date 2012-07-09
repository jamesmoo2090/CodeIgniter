<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
{

	// this wil check and see if the session is active or not	
	function __construct()
	{
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username']) ) 
		{
			redirect('admin');
		}

		//needed for the form
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		//s$this->load->model('todolist_model');
	}
	
	//by default load the welcome_message  view
	

	public function index()
	{
		$whois = $_SESSION['username'];
		
		$data['myname'] = $this->db->where('email_address', $whois)
								   ->get('users');
		
		$data['private']= $this->db->where('email_address', $whois)
								   ->where('public_task', 'false')
								   ->order_by('list_name', 'desc')
								   ->get('todolist');
		
		$data['distinctprivate'] = $this->db->where('email_address', $whois)
									->where('public_task', 'false')
									->distinct('list_name')
									->group_by('list_name') 
									->order_by('list_name', 'desc')
						   			->get('todolist');
							
		
		$data['public']= $this->db->where('public_task', 'true')
									->order_by('list_name', 'desc')
						   			->get('todolist');
		
		$data['distinctpublic'] = $this->db->where('public_task', 'true')
									->distinct('list_name')
									->group_by('list_name') 
									->order_by('list_name', 'desc')
						   			->get('todolist');
		
		
		//boiler plate
		//$this->load->view('welcome_message', $data);
		
		$data['title']        = 'Your Todo Lists';
		$data['main_content']= 'welcome_message';
						 
		$this->load->view('template',$data);
		
		
	}
	
	// THIS ONE CONTROLLS ALL THE BUTTONS ON THE VIEW:
	//	WILL SEND TO CRUD OPERATIONs
	function buttonprocess()
	{
		//set the rule to the task ID
		$this->form_validation->set_rules('task_id', 'task_id', '');
		
		//error for the form
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		//run if validation
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//boilerplate
			//$this->load->view('todolist_view');
			
			$data = array (	 'title' => 'Todo List',
						 'main_content' => 'todolist_view'
						  );
			$this->load->view('template', $data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
							'task_id' =>set_value('task_id') 
							  );
		}
		//delete item
		if(isset($_POST["delete_task"])) 
		{
			$this->load->model('todolist_model');
			$this->todolist_model->deletetask($form_data);
		}
		
		
		//edit existing task
		if(isset($_POST["edit_task"])) 
		{
			$editwhat = $form_data['task_id'];
			
			$editdata['sql']= $this->db->where('task_id', $editwhat)
								   	   ->get('todolist');
			

			//boilerplate					   
			//$this->load->view('edit_view',$editdata);
			
						
			$editdata['title'] = 'Edit Task';
			$editdata['main_content'] = 'edit_view';
			
			$this->load->view('template', $editdata);
		}
		

	}

	function createnewlist()
	{
		//boilerplate
		//$this->load->view('newlist_view');
		$editdata['title'] = 'New List & Task';
		$editdata['main_content'] = 'newlist_view';
			
		$this->load->view('template', $editdata);
		
	} 
	
	function newprivate()
	{
		//boilerplate
		//$this->load->view('private_view');
		$editdata['title'] = 'New List & Task';
		$editdata['main_content'] = 'newprivatelist';
			
		$this->load->view('template', $editdata);
	} 
	
	function newlist()
	{
		$this->load->model('todolist_model');			
		$this->form_validation->set_rules('email_address', 'email Address', 'max_length[256]');			
		$this->form_validation->set_rules('public_task', 'Set Public or Private', 'required|max_length[10]');			
		$this->form_validation->set_rules('list_name', 'List Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_name', 'Task Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_description', 'Task Description', '');			
		$this->form_validation->set_rules('file_url', 'Upload File', 'max_length[250]');			
		$this->form_validation->set_rules('task_status', 'Task Status', 'required|max_length[50]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//boilerplate
			//$this->load->view('todolist_view');
			$editdata['title'] = 'Todo Lists';
			$editdata['main_content'] = 'todolist_view';
			
			$this->load->view('template', $editdata);
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
					       	'file_url' => set_value('file_url'),
					       	'task_status' => set_value('task_status')
						);
					
			// run insert model to write data to db
		
			if ($this->todolist_model->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('welcome');   // or whatever logic needs to occur
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
			echo 'New List & Task has been added';
	}


	function edittask()
	{
		//Load helpers
		$this->load->model('edit_task');
		$this->load->helper('string');
					
		//Validation rules			
		$this->form_validation->set_rules('email_address', 'email Address', 'max_length[256]');			
		$this->form_validation->set_rules('public_task', 'Set Public or Private', 'required|max_length[10]');			
		$this->form_validation->set_rules('list_name', 'List Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_name', 'Task Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('task_description', 'Task Description', '');			
		$this->form_validation->set_rules('file_url', 'Upload File', 'max_length[250]');			
		$this->form_validation->set_rules('task_status', 'Task Status', 'required|max_length[50]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$editdata['title'] = 'Todo Lists';
			$editdata['main_content'] = 'todolist_view';
			
			$this->load->view('template', $editdata);
		}
		else // passed validation proceed to post success logic
		{
			$form_data = array(
							'task_id' => set_value('task_id'),
					       	'email_address' => set_value('email_address'),
					       	'public_task' => set_value('public_task'),
					       	'list_name' => set_value('list_name'),
					       	'task_name' => set_value('task_name'),
					       	'task_description' => set_value('task_description'),
					       	'file_url' => set_value('file_url'),
					       	'task_status' => set_value('task_status')
						);	 
						
			$taskid; $count = 0;			
			foreach ($_POST as $item)
			{
				if ($count == 0)
				{
					$taskid = trim_slashes($item);
					$count = 10;
				}
				
			}
			
			
			$form_data['task_id'] = $taskid;
			
			//had to do the update here, the model would not do it for some reason
			$this->db->where('task_id', $taskid)
				 ->update('todolist', $form_data);
			
			//boilerplate
			redirect(welcome);
			
		}	
	}

	public function cancelbutton()
	{
		redirect(welcome);
	}
}
	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
