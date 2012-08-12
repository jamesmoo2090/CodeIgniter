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
		$this->load->library('upload');
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
			
			// ============== EDITING FOR GETTING ALL PUBLIC LISTS ===================================
			$useris = $_SESSION['username'];
			
			$prlists = 'SELECT list_name FROM todolist WHERE email_address="'.$useris.'" AND public_task="false" GROUP BY list_name';
			$pblists = 'SELECT list_name FROM todolist WHERE public_task="true" GROUP BY list_name';
			
			$editdata['privatelists'] = $this->db->query($prlists);
			$editdata['publiclists'] = $this->db->query($pblists);
			
			//================= SEND TO THE VIEW TEMPLATE ============================================
						
			$editdata['title'] = 'Edit Task';
			$editdata['main_content'] = 'edit_view';
			
			$this->load->view('template', $editdata);
		}
		

	}

	function createnewlist()
	{
		// ============== EDITING FOR GETTING ALL PUBLIC LISTS ===================================
		$useris = $_SESSION['username'];
			
		$prlists = 'SELECT list_name FROM todolist WHERE email_address="'.$useris.'" AND public_task="false" GROUP BY list_name';
		$pblists = 'SELECT list_name FROM todolist WHERE public_task="true" GROUP BY list_name';
			
		$editdata['privatelists'] = $this->db->query($prlists);
		$editdata['publiclists'] = $this->db->query($pblists);
			
		//================= SEND TO THE VIEW TEMPLATE ============================================
						
		$editdata['title'] = 'New List & Task';
		$editdata['main_content'] = 'newlist_view';
			
		$this->load->view('template', $editdata);
		
	} 
	
	function newprivate()
	{
		// ============== EDITING FOR GETTING ALL PUBLIC LISTS ===================================
		$useris = $_SESSION['username'];
			
		$prlists = 'SELECT list_name FROM todolist WHERE email_address="'.$useris.'" AND public_task="false" GROUP BY list_name';
		$pblists = 'SELECT list_name FROM todolist WHERE public_task="true" GROUP BY list_name';
			
		$editdata['privatelists'] = $this->db->query($prlists);
		$editdata['publiclists'] = $this->db->query($pblists);
			
		//================= SEND TO THE VIEW TEMPLATE ============================================
		
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
	
	public function filemedia()
	{
		//gets the name of the list 
		$this->form_validation->set_rules('list_name', 'List Name', 'required|max_length[256]');	
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		$this->form_validation->run();
		//echo "validation ran";
		
		$form_data = array('list' => set_value('list_name'));
		$list = $form_data['list'];
		
		//echo $list;
		
		//redirect to the view for work being done
		$editdata['list_name'] = $list;
		$editdata['title'] = 'New List & Task';
		$editdata['main_content'] = 'file_view';
			
		$this->load->view('template', $editdata);
		
		
	}

	public function do_upload()
	{
				
		if (isset($_POST['submit']))
    	{
        	$this->load->library('upload');
 
	        // Check if there was a file uploaded - there are other ways to
    	    // check this such as checking the 'error' for the file - if error
        	// is 0, you are good to code
        	if (!empty($_FILES['userfile']['name']))
        	{
	            // Specify configuration for File 1
	            $config['upload_path'] = 'uploads/';
	            $config['allowed_types'] = 'mp4|mp3';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				
	        	// Initialize config for File 1
	            $this->upload->initialize($config);
	 
	 			
	 			//get the file name 
	 			$fileUploaded = $_FILES['userfile']['name'];
					
				//add _ for all the spaces in the file name
				$this->load->helper('inflector');
				$fileUploaded = underscore($fileUploaded);
				
				//get the list name this file should be associated with
				$list_name = $_POST['list_name'];
					
				$saveDB['filename']  = $fileUploaded;
				$saveDB['list_name'] = $list_name;	
				$this->load->model('file_model');	
					
	            // Upload file 1
	            if ($this->upload->do_upload('userfile'))
	            {
	                //$data = $this->upload->data();
	                $sendToDB = $this->file_model->SaveFile($saveDB);
	                
					if ($sendToDB == TRUE)
					{
						$data['title']        = 'Upload Successful';
						$data['main_content'] = 'filesuccess_view';
						//echo "FILE SUCCESS";
						$this->load->view('template',$data);
		
					}
					if ($sendToDB == FALSE)
					{
						$data['title']        = 'Failed to Upload';
						$data['main_content'] = 'filefailure_view';
						//echo "File Failure";
						$this->load->view('template',$data);
					}
					
	            }
            	else
	            {
	                echo $this->upload->display_errors();
	            }
			}
		}
	}

	public function delete_file()
	{
		$this->form_validation->set_rules('list_name', 'List Name', 'required|max_length[256]');			
		$this->form_validation->set_rules('file_name', 'File Name', 'required|max_length[512]');	
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		$this->form_validation->run();
		//echo "validation ran";
		
		$form_data = array( 'list' => set_value('list_name'),
							'file' => set_value('file_name')
							);
							
		$list = $form_data['list'];
		$file = $form_data['file'];
		
		$data['list_name'] = $list;
		$data['file_name'] = $file;
		
		$this->load->model('file_model');
		$sent = $this->file_model->DeleteFile($data);
		
		if ($sent == TRUE)
		{
			$data['title']        = 'File is being deleted';
			$data['main_content'] = 'deleted_view';
			//echo "FILE SUCCESS";
			$this->load->view('template',$data);
		}
		else 
		{
			echo "failure";
		}		
		
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
