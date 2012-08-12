<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

   // creates the session
   public function __construct()
   {
      session_start();
      parent::__construct();
	  $this->load->database();
	  $this->load->helper('form');
	  $this->load->helper('url');
	  $this->load->library('form_validation');
		
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
		$this->form_validation->set_rules('password', 'Password', 'min_length[4]|required');

		$this->form_validation->set_error_delimiters('<br /><span class="error" style="color:white"><b>', '</b></span><p>');

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
		
		//boilerplate changes
		//$this->load->view('login_view');
		$data = array (	 'title' => 'Todo List - Login',
						 'main_content' => 'login_view'
						 );
		$this->load->view('template', $data);
	}

	//logout function for the user
	public function logout()
	{
		//boilerplate
		//$this->load->view('login_view');
		session_destroy();
		$data = array (	 'title' => 'Todo List - Login',
						 'main_content' => 'login_view'
						 );
		$this->load->view('template', $data);

	}
	
	
	public function profile()
	{
		$email = $_SESSION['username'];
		$data = array (	 'title' => 'My Profile',
						 'main_content' => 'profile_view',
						 'user' =>$email
						 );
		$data['sql']= $this->db->query('SELECT * FROM users WHERE email_address="'.$email.'"');
		
		
		$this->load->view('template', $data);
		
		
	}
	public function editprofile()
	{
		//load the form Validation
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('profile_model');
		
		//START THE FORM VALIDATION
		$this->form_validation->set_rules('first_name', 'first_name', 'min_length[2]|required','max_length[40]|required','required');			
		$this->form_validation->set_rules('last_name', 'last_name', 'min_length[2]|required','max_length[40]|required','required');	
		$this->form_validation->set_rules('email_address', 'email_address', 'valid_email|required','max_length[50]|required','required');			
		$this->form_validation->set_rules('password', 'password', 'min_length[4]|required','max_length[128]|required','required');
		$this->form_validation->set_error_delimiters('<br /><span class="error" style="color:red"><b>', '</b></span>');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//boiler plate
			//$this->load->view('register_view');
			
		$email = $_SESSION['username'];
		$data = array (	 'title' => 'My Profile',
						 'main_content' => 'profile_view',
						 'user' =>$email
						 );
		$data['sql']= $this->db->query('SELECT * FROM users WHERE email_address="'.$email.'"');
		
		
		$this->load->view('template', $data);
						 

		}
		else // passed validation proceed to post success logic
		{
			//this will check to see if the password has changed
			$email = $_SESSION['username'];
			$p= $this->db->query('SELECT password FROM users WHERE email_address="'.$email.'"');
			$cpass = "";
			
			foreach ($p->result() as $row)
			{
				$cpass = $row->password;	
			}
			
			
			//echo $cpass;
			
			$oldemail = $_SESSION['username'];
			$form_data = array(
					       	'first_name' => set_value('first_name'),
					       	'last_name' => set_value('last_name'),
					       	'email_address' => set_value('email_address'),
					       	'password' => set_value('password')
						);
					
			$form_data['oldemail'] = $oldemail;
			// make the password a SHA1 only if it does not match the old password
			if ($cpass != $form_data['password'])
			{
				$form_data['password'] = sha1(set_value('password'));
			}
			
			if ($this->profile_model->updateuser($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('admin/logout');   // or whatever logic needs to occur
			}
		}
	}
	
	public function user_updated()
	{
		$data = array (	 'title' => 'User Updated - Success',
						 'main_content' => 'userupdated_view'
						 );
		$this->load->view('template', $data);
		
	}

}