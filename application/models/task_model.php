<?php
	
	function task_update()
	{
		$this->load->database();
		$data = array(
			'email_address'=>$this->input->post('email_address'),
			'public_task'=>$this->input->post('public_task'),
			'list_name'=>$this->input->post('list_name'),
			'task_name'=>$this->input->post('task_name'),
			'task_description'=>$this->input->post('task_description'),
			'task_status'=>$this->input->post('task_status')
		);

		$this->db->where('id',$this->input->post('id'));
		$this->db->update('books',$data); 
	}
	

?>