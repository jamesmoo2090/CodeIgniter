

		<!-- GET THE NAME OF THE USER FROM THE DATABASE -->
		<div class='welcomeuser'><center>
		<?php  
			echo "<h2> Welcome ";
			foreach($myname->result() as$row)	
			{
				echo $row->first_name;
				echo " ";
				echo $row->last_name;
				
				echo "<br><b><a href=".site_url('admin/profile').">My Profile</a></b>";
				
			}
			//echo '<br>'.$_SESSION['username'];
			echo "</h2>";
			echo form_open('admin/logout'); 
			echo "<input type='submit'  value='Logout' name='logout' id='logout' />";
			echo form_close(); 	
			
		?>
	<br>
	
	
	
	<?php
			//$em = $_SESSION['username'];
			//echo form_open('profile/whoami($em)'); 
			//echo "<input type='submit'  value='My Profile' name='profile' id='profile' />";
			//echo form_close(); 
	?>
	
	
	</h1><p></p></center></div>
	<p>
	<!-- LOGOUT BUTTON -->
	
	</p>
		<div class='publicorprivate'><h2><center>Public Lists</h2></center>
	<!-- GET ALL THE NAMES OF THE PUBLIC LISTS-->
	<p>
	

		<?php echo form_open('welcome/createnewlist');
		echo "<input type='hidden' value='privatelist' name='privatelist' id='privatelist'/>";
		echo "<center><input type='submit' value='Create New Public List & Task' name='new_list' id='new_list'/></center>";       
		echo form_close();?>
		<p>
	</div>
		
		<p>

	<?php 
		$count = 0;
		

		//gets the list name
		foreach($distinctpublic->result() as$row)	
		{//list	
			
			echo "<div class='listsonly'>";
			$list_name =  $row->list_name;
			echo "<center><h2>List Name: " . $list_name."</h2>";
			
			// HERE IS THE REDIRECT LINK TO FILES ON THIS LIST
			
			$att = array('class' => '', 'id' => '');
			echo form_open('welcome/filemedia', $att);
			echo '<input type="hidden" name="list_name" value="'. $list_name.'"/>';	
			echo form_submit('submit', 'Files for this List');		
			echo form_close();
			echo "</p>";
			
			// HERE IS THE REDIRECT LINK TO FILES ON THIS LIST
			
			
			
			
			//gets the task name
			foreach ($public->result() as $item)
			{//task
				
				$task_name = $item->task_name;
				$list = $item->list_name;
				$description = $item->task_description;
				$status = $item->task_status;
				$file   = $item->file_url;
				$count = $count + 1;
				
				//echo "<ul>";
				if ($count > 1)
				{
					//echo "<ul>";
				}
				
				if($list == $list_name)
				{//group with list
				
					echo "<b>Task: </b>" . $task_name."<br>";
					echo "<b>Description: </b>".$description."<br>";
					echo "<b>Status: </b>". $status."<br>";
					
					if ($file != '')
					{
						echo '<b>Internet Link: </b> <a href="http://'.$file.'">Link to file</a>';
					}
			
					
					
					$attributes = array('class' => '', 'id' => '');
					 
					echo form_open('welcome/buttonprocess', $attributes);
					
					$task_id = $item->task_id;
					echo "<input type='hidden' name='task_id' value=". $task_id."/>";	
					
					// delete show the buttons on the view	
					echo "<input type='submit'  value='Edit Task' name='edit_task' id='edit_task' />"; 
					echo "&nbsp &nbsp &nbsp"; 
					echo "<input type='submit'  value='Delete Task' name='delete_task' id='delete_task' />";        
					echo form_close();
					echo "</p>";
				}//group with list
				
			}//task 
			echo '</center></div><p>';
		}//list
	
		if ($count == 0)
		{
			echo "<div class='listsonly'><center>";
			echo "<p><i>You have no Public Lists/Tasks</i></p>";
			echo "</center></div>";
		}
		

	?>
	
	
	
	<!-- GET ALL THE NAMES OF THE PRIVATE LISTS BELONGING TO THE USER -->
	<p>
	<div class='publicorprivate'><h2><center>Private Lists</center></h2>
	<p>
		<?php echo form_open('welcome/newprivate');
		echo "<input type='hidden' value='privatelist' name='privatelist' id='privatelist'/>";
		echo "<center><input type='submit' value='Create New Private List & Task' name='new_list' id='new_list'/></center>";       
		echo form_close();?>
		
	</div>
	<p></p> 
	<?php 
		$count = 0;
		
				//gets the list name
		foreach($distinctprivate->result() as$row)	
		{//list	
			echo "<div class='listsonly'>";
			$list_name =  $row->list_name;
			echo "<center>";
			echo "<h2>List Name: " . $list_name."</h2>";
			
						// HERE IS THE REDIRECT LINK TO FILES ON THIS LIST
			
			$att = array('class' => '', 'id' => '');
			echo form_open('welcome/filemedia', $att);
			echo '<input type="hidden" name="list_name" value="'. $list_name.'"/>';	
			echo form_submit('submit', 'Files for this list');		
			echo form_close();
			echo "</p>";
			
			// HERE IS THE REDIRECT LINK TO FILES ON THIS LIST
			
		
			 
			
			//gets the task name
			foreach ($private->result() as $item)
			{//task
				
				$task_name = $item->task_name;
				$list = $item->list_name;
				$description = $item->task_description;
				$status = $item->task_status;
				$file   = $item->file_url;
				$count = $count + 1;
				
				//echo "<ul>";
				if ($count > 1)
				{
					//echo "<ul>";
				}
				
				if($list == $list_name)
				{//group with list
					
					echo "<b>Task: </b>" . $task_name."<br>";
					echo "<b>Description: </b>".$description."<br>";
					echo "<b>Status: </b>". $status."<br>";
					
					if ($file != '')
					{
						echo '<b>Internet Link: </b> <a href="http://'.$file.'">Link to file</a>';
					}
			
					
					
					$attributes = array('class' => '', 'id' => '');
					 
					echo form_open('welcome/buttonprocess', $attributes);
					
					$task_id = $item->task_id;
					echo "<input type='hidden' name='task_id' value=". $task_id."/>";	
					
					// delete show the buttons on the view	
					echo "<input type='submit'  value='Edit Task' name='edit_task' id='edit_task' />"; 
					echo "&nbsp &nbsp &nbsp"; 
					echo "<input type='submit'  value='Delete Task' name='delete_task' id='delete_task' />";        
					echo form_close();
					echo "</p>";
				}//group with list
				
			}//task 
			echo '</center></div><p>';
		}//list
	
		if ($count == 0)
		{
			echo "<div class='listsonly'><center>";
			echo "<p><i>You have no Private Lists/Tasks</i></p>";
			echo "</center></div>";
		}
		
	?>


