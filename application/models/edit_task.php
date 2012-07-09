<?php

class Edit_task extends CI_Model {

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
		
		$this->db->where('task_id', 'task_id')
				 ->update('todolist', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		

	}
}