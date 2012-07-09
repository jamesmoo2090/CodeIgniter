

		<!-- GET THE NAME OF THE USER FROM THE DATABASE -->
		
		<?php  
			echo "<h2> Welcome ";
			foreach($myname->result() as$row)	
			{
				echo $row->first_name;
				echo " ";
				echo $row->last_name;
				
			}
			echo "</h2>";
			echo form_open('admin/logout'); 
			echo "<input type='submit'  value='Logout' name='logout' id='logout' />";
			echo form_close(); 	
		?>
	</h1>
	<p>
	<!-- LOGOUT BUTTON -->
	
	</p>
		<h3>Public Lists</h3><p></p>
	<!-- GET ALL THE NAMES OF THE PUBLIC LISTS-->
	<p></p>
	

		<?php echo form_open('welcome/createnewlist');
		echo "<input type='hidden' value='privatelist' name='privatelist' id='privatelist'/>";
		echo "<input type='submit' value='Create New Public List & Task' name='new_list' id='new_list'/>";       
		echo form_close();?>
	

	<?php 
		$count = 0;
		
		foreach($distinctpublic->result() as$row)	
		{
			
			$list_name =  $row->list_name;
			echo "<p><b><ul class='rounded-list'><li><b>List Name: </b>" . $list_name . "</li></b>";
			
			
			foreach ($public->result() as $item)
			{
				
				$task_name = $item->task_name;
				$list = $item->list_name;
				$description = $item->task_description;
				$status = $item->task_status;
				$count = $count + 1;
				
				echo "<ul>";
				if ($count > 1)
				{
					echo "<ul>";
				}
				
				if($list == $list_name)
				{
					echo "<li><b>Task: </b>" . $task_name . "</li>";
					echo "<li><b>Description: </b>".$description . "</li>";
					echo "<li><b>Status: </b>". $status."</li></ul>";
					
					$attributes = array('class' => '', 'id' => '');
					 
					echo form_open('welcome/buttonprocess', $attributes);
					
					$task_id = $item->task_id;
					echo "<input type='hidden' name='task_id' value=". $task_id."/>";	
					
					// delete show the buttons on the view	
					echo "<input type='submit'  value='Edit Task' name='edit_task' id='edit_task' />"; 
					echo "&nbsp &nbsp &nbsp"; 
					echo "<input type='submit'  value='Delete Task' name='delete_task' id='delete_task' />";        
					echo form_close();
					
				}
				if ($count > 1)
				{
					echo "</ul></ul>";
				}
				echo "</ul>";
			}	
		}
		if ($count == 0)
		{
			echo "<p><i>You have no Public Lists/Tasks</i></p>";
		}
		
	?>
	
	
	<hr />	
	<!-- GET ALL THE NAMES OF THE PRIVATE LISTS BELONGING TO THE USER -->
	<p>
	<h3>Private Lists</h3><p></p>
	
		<?php echo form_open('welcome/newprivate');
		echo "<input type='hidden' value='privatelist' name='privatelist' id='privatelist'/>";
		echo "<input type='submit' value='Create New Private List & Task' name='new_list' id='new_list'/>";       
		echo form_close();?>
	
	<?php 
		$count = 0;
		
		foreach($distinctprivate->result() as$row)	
		{
			
			$list_name =  $row->list_name;
			echo "<p><b><ul><li>" . $list_name . "</li></b>";
			
			
			foreach ($private->result() as $item)
			{
				
				$task_name = $item->task_name;
				$list = $item->list_name;
				$description = $item->task_description;
				$status = $item->task_status;
				$count = $count + 1;
				
				echo "<ul>";
				if ($count > 1)
				{
					echo "<ul>";
				}
				
				if($list == $list_name)
				{
					echo "<li><b>Task: </b>" . $task_name . "</li>";
					echo "<li><b>Description: </b>".$description . "</li>";
					echo "<li><b>Status: </b>". $status."</li></ul>";
					
					$attributes = array('class' => '', 'id' => '');
					 
					echo form_open('welcome/buttonprocess', $attributes);
					
					$task_id = $item->task_id;
					echo "<input type='hidden' name='task_id' value=". $task_id."/>";	
					
					// delete show the buttons on the view	
					echo "<input type='submit'  value='Edit Task' name='edit_task' id='edit_task' />"; 
					echo "&nbsp &nbsp &nbsp"; 
					echo "<input type='submit'  value='Delete Task' name='delete_task' id='delete_task' />";        
					echo form_close();
					
				}
				if ($count > 1)
				{
					echo "</ul></ul>";
				}
				echo "</ul>";
			}	
		}
		if ($count == 0)
		{
			echo "<p><i>You have no Private Lists/Tasks</i></p>";
		}
		
	?>
	

