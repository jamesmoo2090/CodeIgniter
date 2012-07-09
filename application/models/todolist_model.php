<?php

class Todolist_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
		$this->db->insert('todolist', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		redirect('welcome');
	}
	
	
	function deletetask($form_data)
	{
		$this->load->database();
		
		$this->db->where('task_id', $form_data['task_id'])
				 ->delete('todolist'); 
		
		redirect('welcome');
	}
	
}
?> 