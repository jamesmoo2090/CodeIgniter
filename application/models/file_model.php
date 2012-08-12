<?php

class File_model extends CI_Model {

	//default constructor
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('registration_model');
	}
	


	//get the info from the from and the controller and insert into the database 
	function SaveFile($form_data)
	{
		//this will check to see if the file is already int he DB
		$list = $form_data['list_name'];
		$file = $form_data['filename'];
		
		$send['list_name'] = $list;
		$send['file_name'] = $file;
		
		$check = $this->db->query('SELECT * FROM files WHERE list_name="'.$list.'" AND file_name="'.$file.'"');
		
		if ( $check->num_rows == 0)
		{
			//perform the insert
			
			
			$this->db->insert('files',$send);
			
			if ($this->db->affected_rows() == '1')
			{
				//echo "success";
				return TRUE;
				//redirect(welcome/fileSuccess);
			}
			else 
			{
				echo "ERROR - UNABLE TO SAVE TO THE DATABASE";
			}
			
		}
		if ($check->num_rows > 0)
		{
			//echo 'failure';
			return FALSE;
			//file already in DB
			//redirect(welcome/fileThereAlready);
		}	
			
	}
	
	function DeleteFile($form_data)
	{
		$list = $form_data['list_name'];
		$file = $form_data['file_name'];
		
		$check = $this->db->query('DELETE FROM files WHERE list_name="'.$list.'" AND file_name="'.$file.'"');
		
		return TRUE;
		
			
	
	}
	
}