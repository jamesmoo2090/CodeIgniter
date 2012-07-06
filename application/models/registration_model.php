<?php

class Registration_model extends CI_Model {

	//default constructor
	function __construct()
	{
		parent::__construct();
	}
	


	//get the info from the from and the controller and insert into the database 
	function SaveForm($form_data)
	{
		$this->db->insert('users', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}