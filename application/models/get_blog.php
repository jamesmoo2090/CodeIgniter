<?php
class Get_blog extends CI_Model
{
	function getAll()
	{
		//model does the query
		$query = $this->db->get('blog');
		
		return $query;
	}
}


?>