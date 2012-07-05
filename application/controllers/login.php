<?php
class Login extends CI_Controller
{
	function index()
	{
		$this->load->model('get_blog');
		
		$data['plane'] = "text only";
		
		$data['sql'] = $this->get_blog->getAll();
		

		
		$this->load->view('login_view', $data);
	}
	

	
}
?>