<?php
	//variables used to fill the form field
	$date; $taskid; $email; $list; $task; $desc; $file; $status;$publicis;
	
	foreach ($sql->result() as $item)
	{
		$taskid  =  $item->task_id;
		$email   =  $item->email_address;
		$list    =  $item->list_name;
		$task    =  $item->task_name;
		$desc    =  $item->task_description;
		$file    =  $item->file_url;
		$status  =  $item->task_status;
		$publicis = $item->public_task;
	}

?>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('welcome/edittask', $attributes); 

	
?>
    	<input id="task_id" type="hidden" name="task_id" maxlength="256" value="<?php echo set_value('task_id', $taskid); ?>"  />
    	<input id="email_address" type="hidden" name="email_address" maxlength="256" value="<?php echo set_value('email_address',$email); ?>"  />


<br/>
        <label for="public_task">Make List & Task Public or Private?</label>
        <?php echo form_error('public_task');
        echo '<br />';
		// Change or Add the radio values/labels/css classes to suit your needs
		if ($publicis == 'true')
		{
	        echo '<input id="public_task" name="public_task" type="radio" class="" value="true" '.$this->form_validation->set_radio('public_task', 'true').'checked/>';
	        echo '<label for="public_task" class="">Public List</label>';
			echo "&nbsp&nbsp";
	        echo '<input id="public_task" name="public_task" type="radio" class="" value="false" '.$this->form_validation->set_radio('public_task', 'false').'/>';
	        echo '<label for="public_task" class="">Private List</label>';
		}
		if ($publicis == 'false')
		{
			echo '<input id="public_task" name="public_task" type="radio" class="" value="true" '.$this->form_validation->set_radio('public_task', 'true').'/>';
	        echo '<label for="public_task" class="">Public List</label>';
			echo "&nbsp&nbsp";
	        echo '<input id="public_task" name="public_task" type="radio" class="" value="false" '.$this->form_validation->set_radio('public_task', 'false').'checked/>';
	        echo '<label for="public_task" class="">Private List</label>';
		}
        ?>
</p>


<p>
        <label for="list_name">List Name <span class="required">(required field)</span></label>
        <?php echo form_error('list_name'); ?>
        <br /><input id="list_name" type="text" name="list_name" maxlength="256" value="<?php echo set_value('list_name',$list); ?>"  />
</p>

<p>
        <label for="task_name">Task Name <span class="required">(required field)</span></label>
        <?php echo form_error('task_name'); ?>
        <br /><input id="task_name" type="text" name="task_name" maxlength="256" value="<?php echo set_value('task_name',$task); ?>"  />
</p>

<p>
        <label for="task_description">Task Description</label>
        <?php echo form_error('task_description'); ?>
        <br /><input id="task_description" type="text" name="task_description"  value="<?php echo set_value('task_description',$desc); ?>"  />
</p>

<p>
        <label for="file_url">Link to file on the web (Chuck Norris)</label>
        <?php echo form_error('file_url'); ?>
        <br /><input id="file_url" type="text" name="file_url" maxlength="250" value="<?php echo set_value('file_url',$file); ?>"  />
</p>

<p>
        <label for="task_status">Current Task Status</label>
        <?php echo form_error('task_status'); ?>
        <br />
  		
  		<?php 
  			if ($status == "Not Started")
  			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'checked/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
			   echo "&nbsp&nbsp";		
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        	   echo "&nbsp&nbsp";	
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        	   echo "&nbsp&nbsp";	
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
				  				
  			}
  			if ($status == "In Progress")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
			   echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'checked/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
               echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
							
			}
			if ($status == "Completed")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
				echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'checked/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
			
			}
			if ($status == "Postponed")
			{
			   echo '<input id="task_status" name="task_status" type="radio" class="" value="Not Started"'.$this->form_validation->set_radio('task_status', 'Not Started').'/>';
        	   echo '<label for="task_status" class="">Not Started</label>';
				echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="In Progress"'.$this->form_validation->set_radio('task_status', 'In Progress').'/>';
        	   echo '<label for="task_status" class="">In Progress</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Completed"'.$this->form_validation->set_radio('task_status', 'Completed').'/>';
        	   echo '<label for="task_status" class="">Completed</label>';
        		echo "&nbsp&nbsp";
        	   echo '<input id="task_status" name="task_status" type="radio" class="" value="Postponed"'.$this->form_validation->set_radio('task_status', 'Postponed').'checked/>';
        	   echo '<label for="task_status" class="">Postponed</label>';
			
			}
  		?>

				
	
</p>



<p>
        <?php 
        	echo form_submit( 'submit', 'Save Changes'); 
        ?>
</p>

<?php   echo form_close(); 
		echo form_open('welcome/cancelbutton');
		echo form_submit('submit', 'Cancel');
		echo form_close();
?>

